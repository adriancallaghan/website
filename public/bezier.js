

function bezier(globals){


    this.globals = globals;
    this.indexes = {}    
    this.indexes['start'] = {};
    this.indexes['end'] = {};
    this.indexes['cp1'] = {};
    this.indexes['cp2'] = {};


    this.init = function(){ 
         
        var axis = Math.floor((Math.random()*this.globals.c1.width)+1);
        var arch = 200;

        this.indexes['start']['x'] = axis; // position width ways
        this.indexes['start']['y'] = -1; // from top
        this.indexes['end']['x'] = axis;
        this.indexes['end']['y'] = this.globals.c1.height + 1; // from top
        this.indexes['cp1']['x'] = axis + arch; 
        this.indexes['cp1']['y'] = this.globals.c1.height / 4 * 1; 
        this.indexes['cp2']['x'] = axis + arch; 
        this.indexes['cp2']['y'] = this.globals.c1.height / 4 * 3; 


        this.speed = Math.floor((Math.random()*100)+1);
        this.color = '#fff';
        this.width = Math.floor((Math.random()*3)+1);
        this.inverted = false;   
        this.animation = Math.floor((Math.random()*2)+1);
        //this.animation = 3;
        this.ttl = Math.floor((Math.random()*100)+1);

     }

     this.draw = function(context){    
         
        context.beginPath();   
        context.moveTo(this.indexes['start']['x'], this.indexes['start']['y']);
        context.bezierCurveTo(
            this.indexes['cp1']['x'], 
            this.indexes['cp1']['y'], 
            this.indexes['cp2']['x'], 
            this.indexes['cp2']['y'], 
            this.indexes['end']['x'], 
            this.indexes['end']['y']
        );
        context.lineWidth = this.width;          
        context.strokeStyle = this.color;
        context.stroke();  

        return this;
     }

     this.animate = function(){

        if (this.ttl<1){
            this.init();
            return;
        } else {
            this.ttl--;
        }

        switch(this.animation){
             
             case 1:                  
                this.indexes['cp1']['y']+= this.speed;
                this.indexes['cp1']['x']+= this.speed; 
                this.indexes['cp2']['x']+= this.speed; 
                this.indexes['start']['x']-= this.speed;  
                if (this.speed>5 && this.ttl<100){
                    this.speed--;
                }
            break;             
            case 2:                 
                this.indexes['cp1']['y']-= this.speed;
                this.indexes['cp1']['x']-= this.speed; 
                this.indexes['cp2']['x']-= this.speed; 
                this.indexes['end']['x']-= this.speed;  
                if (this.speed>5 && this.ttl<100){
                    this.speed--;
                }
            break;
            case 3:                  
                this.indexes['start']['y']-= this.speed;
                this.indexes['cp1']['x']+= this.speed; 
                this.indexes['cp2']['x']+= this.speed; 
                this.indexes['end']['x']+= this.speed;  
                if (this.speed>5 && this.ttl<100){
                    this.speed--;
                }
            break;             
            case 4:                 
                this.indexes['start']['y']+= this.speed;
                this.indexes['cp1']['x']+= this.speed; 
                this.indexes['cp2']['x']+= this.speed; 
                this.indexes['end']['x']+= this.speed; 
            break;     
             
         }
         
         return this;
     }

     this.update = function(){
         this.animate();
         return this;
     }


     this.init();
 }

