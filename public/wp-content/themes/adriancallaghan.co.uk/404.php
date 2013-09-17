<?php get_header(); ?>

    <?php 
    // http://gotoandlearn.com/play.php?id=167
    $panels = array(
        array(
            0=>array(6,7),
            1=>array(5,6,7),
            2=>array(4,5,6,7),
            3=>array(3,4,6,7),
            4=>array(2,3,6,7),
            5=>array(1,2,3,4,5,6,7,8,9,10),
            6=>array(2,3,4,5,6,7,8,9),
            7=>array(6,7),
            8=>array(6,7),
            9=>array(6,7),
            ),
        array(
            0=>array(5,6),
            1=>array(4,5,6,7),
            2=>array(3,4,7,8),
            3=>array(2,3,8,9),
            4=>array(1,2,9,10),
            5=>array(1,2,9,10),
            6=>array(2,3,8,9),
            7=>array(3,4,7,8),
            8=>array(4,5,6,7),
            9=>array(5,6),
            ),
        array(
            0=>array(6,7),
            1=>array(5,6,7),
            2=>array(4,5,6,7),
            3=>array(3,4,6,7),
            4=>array(2,3,6,7),
            5=>array(1,2,3,4,5,6,7,8,9,10),
            6=>array(2,3,4,5,6,7,8,9),
            7=>array(6,7),
            8=>array(6,7),
            9=>array(6,7),
            ),
        );
    $panelSpan = 'span'.floor(12/count($panels));
    $panelHeight = 10;
    ?>

    <div class="row-fluid" role="main" style='margin-top: 5%;'>
        
        <?php foreach($panels AS $panel): ?>
            
            <div class="<?php echo $panelSpan; ?>">                
                
                <?php for($level=0; $level<$panelHeight; $level++){ ?>
                    <div class="row-fluid" style='margin: 1% 0;'>

                            <?php
                            for($position=0; $position<12; $position++){

                                if (isset($panel[$level]) && in_array($position, $panel[$level])){
                                    echo '<div class="span1 lcd_active"></div>'; 
                                } else {
                                    echo '<div class="span1 lcd_inactive"></div>'; 
                                }

                            }

                        ?>
                    </div>
                <?php } ?>
            </div>
        
            
        <?php endforeach; ?>
        
                
        
        <!--h2 class="center">Just what do you think your doing Dave?</h2-->

    </div>

<?php get_footer(); ?>