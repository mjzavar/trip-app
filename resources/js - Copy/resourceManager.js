import axios from "axios";

class resourceManager {

    constructor (emitter) {
        this.renderData = {}
        this.components = {};
        this.emitter = emitter
    }

    registerResoures(component, resources ){
        this.components[component] = resources ;
        resources.forEach((item) => this.render(item.route) )
    }

    findResource(component , routename ){
        return this.components[component]?.find( resource  => resource.route.name === routename) || null ;
    }

    updateResources(routes){
        routes.forEach( (route) => this.render({name : route  , overwrite:true } ) );
    }


    async render( {name , payload = {}, method = 'get'  , overwrite = false }  ){
        console.log('call' ,  {name , payload , method   , overwrite  })

        if(!overwrite && this.renderData[name])
        {
            return this.renderData[name];
        }

        this.renderData[name] = {
            status : 'loading' ,
            data : [] ,
        };


        try {
            let data  = (await axios[method]( route(name  , payload) )).data

            this.renderData[name] = {
                error : null  ,
                data : data
            };
        } catch (error) {

            this.renderData[name] = {
                error : { status : error.response?.status , message : error?.response?.data?.message || error.toString() } ,
                data : [] ,
            };
        }
        finally {
            this.emitter.emit("resourceRendered" ,  { route : name ,  resource : this.renderData[name] });
        }

        return this.renderData[name] ;
    }


}

export {resourceManager } ;
