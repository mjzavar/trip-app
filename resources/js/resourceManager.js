import axios from "axios";

class resourceManager {

    constructor (emitter) {
        this.resources = {}
        this.components = {};
        this.loadQueue = {};
        this.resourceProgress = false  ;
        this.emitter = emitter
        setInterval(()=>{

            if( Object.keys(this.loadQueue).length  > 0)
            {
                if(this.resourceProgress === false )
                {
                    this.resourceProgress = true
                    this.emitter.emit("resourceProgress" , true );
                }
            }
            else if(this.resourceProgress === true  )
            {
                this.resourceProgress = false
                this.emitter.emit("resourceProgress" , false  );
            }
        }, 1000 );
    }




    registerResoures(component, resources ){
        let component_key =   component.$options.__file?.split('resources/') [1]|| component.$.uid;
        this.log(` registering registerResoures ${component_key}`)
        this.components[component_key] = {component , resources} ;
        resources.forEach((item) => this.callApi(item.route) )
        this.fillComponent(component_key)
    }


    updateResources(routes){
        routes.forEach( (route) => this.callApi({name : route  , overwrite:true } ) );
    }


    async callApi({name , payload = {}, method = 'get'  , overwrite = false }  ){
        this.log('call -> ')
        this.log( {name , payload , method   , overwrite  })

        if(!overwrite && this.resources[name])
        {
            this.log('already in queue')
            return this.resources[name];
        }

        this.resources[name] = {
            status : 'loading' ,
            data : [] ,
        };
        this.log('fire')

        let requestID  = "id" + Math.random().toString(16).slice(2) ;
        this.loadQueue[requestID] = new Date().toString();

        try {
            let data  = (await axios[method]( route(name  , payload) )).data

            this.resources[name] = {
                error : null  ,
                data : data
            };
        } catch (error) {

            this.resources[name] = {
                error : { status : error.response?.status , message : error?.response?.data?.message || error.toString() } ,
                data : [] ,
            };
        }
        finally {
            this.emitter.emit("resourceRendered" ,  { route : name ,  resource : this.resources[name] });
            this.addResourceToComponents(name);
            delete  this.loadQueue[requestID];
        }

        return this.resources[name] ;
    }

    addResourceToComponents(availableResourceRouteName){
        for (const componentName in this.components) {
            this.components[componentName].resources.forEach( (componentResource) => {
                if(availableResourceRouteName === componentResource.route.name )
                {
                    this.components[componentName].component[componentResource.resource] = this.resources[availableResourceRouteName].data
                }
            })
        }
    }

    fillComponent(componentName ){

        for (const resourceRouteName  in this.resources) {
            this.components[componentName].resources.forEach( (componentResource) => {
                if(resourceRouteName === componentResource.route.name )
                {
                    this.components[componentName].component[componentResource.resource] = this.resources[resourceRouteName].data
                }
            })
        }

    }

    log(log){
        return ;
        console.log(log)
    }



}

export {resourceManager } ;
