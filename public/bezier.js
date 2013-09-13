

function bezier(globals, position){


    this.globals = globals;
    this.position = position;
    this.indexes = {}    
    this.indexes['start'] = {};
    this.indexes['end'] = {};
    this.indexes['cp1'] = {};
    this.indexes['cp2'] = {};
    this.boundary = 3;
    this.behaviourDelay = 200;

    this.init = function(){ 
         
        console.log('initialising bezier at position ' + this.position);
         
        this.phase = 0;
        this.phaseSinMultiplier = 120;
        this.phaseCoSinMultiplier = 120;
        this.speed = 10;       
        this.color = "RGB(255,255,255)";
        this.width = 0.1;
        this.behaviour = 0;
        this.tick = 0;

         
        // initilaize bezier in position, default is box 1
        switch(this.position){

            // top left to bottom right
            case 1:
            default:
                this.indexes['start']['x'] = 0; // position width ways
                this.indexes['start']['y'] = 0; // from top        
                this.indexes['end']['x'] = this.globals.c1.width;
                this.indexes['end']['y'] = this.globals.c1.height; // from top
            break;
            // bottom left to top right
            case 2:
                this.indexes['start']['x'] = this.globals.c1.width; // position width ways
                this.indexes['start']['y'] = 0; // from top        
                this.indexes['end']['x'] = 0;
                this.indexes['end']['y'] = this.globals.c1.height; // from top
            break;
            // vertical
            case 3:
                this.indexes['start']['x'] = this.globals.c1.width/2; // position width ways
                this.indexes['start']['y'] = 0; // from top        
                this.indexes['end']['x'] = this.globals.c1.width/2;
                this.indexes['end']['y'] = this.globals.c1.height; // from top
            break;
            // horizontal
            case 4:                
                this.indexes['start']['x'] = 0; // position width ways
                this.indexes['start']['y'] = this.globals.c1.height/2; // from top        
                this.indexes['end']['x'] = this.globals.c1.width;
                this.indexes['end']['y'] = this.globals.c1.height/2; // from top
            break;
                
        }
        

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

     this.calcBounds = function(value){
         
         // box 1
         if (value['x'] >= this.boundary && value['y'] <= this.boundary){
             if (value['x'] > this.globals.c1.width - this.boundary){
                 value['y']+= this.speed;                 
             } else {
                value['x']+= this.speed;  
             }
         }
         // box 2
         else if (value['x'] >= this.globals.c1.width - this.boundary && value['y'] >= this.boundary){
             if (value['y'] > this.globals.c1.height - this.boundary){
                value['x']-= this.speed;
             } else {
                value['y']+= this.speed;
             }             
         }
         // box 3
         else if (value['x'] <= this.globals.c1.width - this.boundary && value['y'] >= this.globals.c1.height - this.boundary){      
             if (value['x'] < this.boundary){
                 value['y']-= this.speed;                 
             } else {
                value['x']-= this.speed;  
             }
         }
         // box 4
         else {
             if (value['y'] < this.boundary){
                value['x']+= this.speed;
             } else {
                value['y']-= this.speed;
             }
         }
         
                  
         return value;
     }

     
     this.animate = function(){

        this.phase+=0.09;        
        this.indexes['start'] = this.calcBounds(this.indexes['start']);
        this.indexes['end'] = this.calcBounds(this.indexes['end']);        
        this.indexes['cp1']['x'] = this.globals.c1.width/2 + Math.cos(this.phase) * this.phaseCoSinMultiplier;  
        this.indexes['cp1']['y'] = this.globals.c1.height/2 + Math.sin(this.phase) * this.phaseSinMultiplier; 
        this.indexes['cp2']['x'] = this.globals.c1.width/2 + Math.cos(this.phase) * this.phaseCoSinMultiplier;  
        this.indexes['cp2']['y'] = this.globals.c1.height/2 + Math.sin(this.phase) * this.phaseSinMultiplier;  
        return this;
     }
     
     this.applyBehaviour = function(){
         
         if (this.tick%this.behaviourDelay==1){        
             this.behaviour++;
             console.log('behaviour change '+ this.behaviour);
        }
        
        switch(this.behaviour){
      
            case 1: 
                if (this.speed >5){
                    this.speed--; 
                }
                if (this.width<0.5){
                    this.width+=.01;    
                }
                break;
            case 2: 
                
                if (this.speed <20){
                    this.speed++; 
                }  
                if (this.width>0.3){
                    this.width-=.01; 
                }
                break;
            case 3: 
                if (this.speed <10){
                    this.speed++; 
                }
                if (this.phaseSinMultiplier < 500){
                    this.phaseSinMultiplier++; 
                }
                if (this.phaseCoSinMultiplier < 500){
                    this.phaseCoSinMultiplier++; 
                }
                if (this.width<0.7){
                    this.width+=.01;    
                }
                break;
            case 4: 
                if (this.phaseSinMultiplier > 120){
                    this.phaseSinMultiplier--; 
                }
                if (this.phaseCoSinMultiplier > 120){
                    this.phaseCoSinMultiplier--; 
                }
                if (this.width>0.5){
                    this.width-=.01; 
                }
                break;
            default:
                this.behaviour = 1;
      
        }
     }

     this.update = function(){          
         
         this.tick++;
         this.applyBehaviour();
         this.animate();
         return this;
     }


     this.init();
 }

