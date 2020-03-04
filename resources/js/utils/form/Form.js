import Errors from './Errors';
class Form{
    constructor(data){
        this.originalData = data;
        
        for (let field in data){
            this[field] = data[field];
        }

        this.errors = new Errors();
        this.sendingMessage = null;
        this.messageSent = false
    }
    
    
    data(){
        let data = {};

        for(let property in this.originalData){
            data[property] = this[property];
        }        

        return data;
    }

    submit(requestType, url){
        this.sendingMessage = true
            return new Promise((resolve, reject)=>{

                axios[requestType](url, this.data())
                .then(response=> {
                    this.onSuccess(response.data);
                    resolve(response.data);
                    this.sendingMessage = false
                    this.messageSent = true
                })

                .catch(error=>{
                    this.onFail(error.response.data.errors);
                    reject(error.response.data);
                    this.sendingMessage = false

                /* .catch(error=>this.errors.record(error.response.data.errors)); */

            });
        });

    }
    post(url){
        return this.submit('post', url)
    }
    delete(url){
        return this.submit('delete', url)
    }
    patch(url){
        return this.submit('patch', url)
    }
    
    submitting(){
        //return "Is Submit"
         //alert('Your form is being created...') 
    }
    
    onSuccess(data){
        this.reset();
    }
    
    onFail(errors){
        this.errors.record(errors)
        
    }

    reset(){
        for (let field in this.originalData){
            this[field] = '';
        }
        this.errors.clear();
        this.sendingMessage = false
         this.messageSent = false
    }
}
export default Form;