<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="<?=routeTo('/')?>" class="logo logo-light">
        <span class="logo-lg">
            <img src="<?=env('APP_SIDEBAR_LOGO', asset('theme/assets/images/logo.png"'))?>" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="<?=env('APP_LOGO', asset('theme/assets/images/logo-sm.png'))?>" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="<?=routeTo('/')?>" class="logo logo-dark">
        <span class="logo-lg">
            <img src="<?=env('APP_SIDEBAR_LOGO',asset('theme/assets/images/logo-dark.png'))?>" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="<?=env('APP_LOGO',asset('theme/assets/images/logo-sm.png'))?>" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <?php foreach(get_menu() as $key => $module): ?>

                <li class="side-nav-title"><?= __($module['moduleName'].'.menu.module_name') ?></li>

                <?php foreach($module['menu'] as $k => $menu): ?>
                    <li class="side-nav-item">
                        <a 
                            class="side-nav-link <?=getActive() == $menu['activeState'] ? 'active' : ''?>"
                            <?php if(isset($menu['items'])) : ?>
                            data-bs-toggle="collapse" href="#sidebar<?=$key?>" aria-expanded="false" aria-controls="sidebar<?=$key?>" 
                            <?php else: ?>
                            href="<?=$menu['route'] ?>" 
                            <?php endif ?>
                            >
                            <i class="<?=$menu['icon']?>"></i>
                            <span> <?=__($menu['label'])?> </span>
                            <?php if(isset($menu['items'])): ?>
                            <span class="menu-arrow"></span>
                            <?php endif ?>
                        </a>

                        <?php if(isset($menu['items'])): ?>
                        <div class="collapse" id="sidebar<?=$key?>">
                            <ul class="side-nav-second-level">
                                <?php if(isset($menu['items'])) foreach($menu['items'] as $item): ?>
                                <li>
                                    <a href="<?=$item['route']?>"><?=__($item['label'])?></a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            <?php endforeach ?>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->