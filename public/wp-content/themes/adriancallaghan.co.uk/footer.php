
        
    
        <div class="row-fluid footer" role="footer">
            <div class="span12">
                <hr>
                <p class="text-right">&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?></p>
            </div>
        </div>
        
        
    </div> <!-- /container -->
        

        <script type="text/javascript">  

          var globals = {
              delay:55,
              alpha:0.97,
              c1: document.getElementById('c1'),
              c2: document.getElementById('c2'),
              c1context: c1.getContext('2d'),
              c2context: c2.getContext('2d')
          };

          var beziers=[
              new bezier(globals,3),
              new bezier(globals,4),
          ];

          function resizeBanner(){

              //var width = globals.c1.parentNode.offsetWidth;
              var width = window.innerWidth;
              var height = window.innerHeight;
              globals.c1.width = width;
              globals.c1.height = height;
              globals.c2.width = width;
              globals.c2.height = height;
              //globals.delay = Math.floor(width/10);
              for (var x in beziers){    
                  beziers[x].init();
              } 
          }

          function tick(){

              globals.c2.width = globals.c2.width; // clear canvas 2
              globals.c2context.globalAlpha = globals.alpha; // set alpha on 2 to slightly faded
              //globals.c2context.globalCompositeOperation = 'lighter';
              globals.c2context.drawImage(c1, 0, 0); // copy 1 to 2 but slightly faded
              for (var x in beziers){    
                  beziers[x].update().draw(globals.c2context) // draw bezier onto canvas 2
              }            
              globals.c1.width = globals.c1.width; // clear canvas 1
              globals.c1context.drawImage(c2, 0, 0); // copy canvas 2 to to canvas 1            
              setTimeout(tick, globals.delay); 
          }


          $(window).resize(resizeBanner);
          $().ready(function(){
              resizeBanner();
              tick();
          });
        </script>
  
        <?php //wp_list_bookmarks(); ?>
        <?php wp_footer(); ?>
        
  </body>
    
</html>