<?php
$configFile = $global['systemRootPath'] . 'videos/configuration.php';


require_once $configFile;
require_once $global['systemRootPath'] . 'plugin/TopMenu/Objects/Menu.php';
require_once $global['systemRootPath'] . 'plugin/TopMenu/Objects/MenuItem.php';

$menu = Menu::getAllActive(1);
?>
<?php
foreach ($menu as $key => $value) {
    ?>
    <li class="dropdown">    
        <a href="#" class=" btn  btn-default btn-light navbar-btn" data-toggle="dropdown" data-toggle="tooltip" title="<?php echo $value['menuName']; ?>" data-placement="bottom" >
            <?php
            $hiddenClass = "hidden-md hidden-sm";
            if (!empty($value['icon'])) {
                ?>
                <i class="<?php echo $value['icon'] ?>"></i> 
                <?php
                $hiddenClass = "hidden-md hidden-sm  hidden-mdx";
            }
            ?>
            <span class="<?php echo $hiddenClass; ?>">
                <?php echo $value['menuName']; ?>
            </span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" id="availableLive" style="">
            <?php
            $menuItems = MenuItem::getAllFromMenu($value['id'], true);
            foreach ($menuItems as $key2 => $value2) {
                $url = $value2['url'];
                if (empty($url) || strpos($url, 'iframe:') !== false) {
                    if (!empty($value2['menuSeoUrlItem'])) {
                        $url = $global['webSiteRootURL'] . "menu/{$value2['menuSeoUrlItem']}";
                    } else {
                        $url = $global['webSiteRootURL'] . "plugin/TopMenu/?id={$value2['id']}";
                    }
                }
                ?>
                <li  style="margin-right: 0;">
                    <a  href="<?php echo $url; ?>" >
                        <?php
                        if (!empty($value2['icon'])) {
                            ?>
                            <i class="<?php echo $value2['icon'] ?>"></i> 
                            <?php
                        }
                        ?>
                        <?php echo $value2['title'] ?>
                    </a>
                </li>            
                <?php
            }
            ?>
        </ul>
    </li>    
    <?php
}
?>

