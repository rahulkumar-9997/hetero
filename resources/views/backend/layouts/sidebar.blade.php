<!-- Sidebar -->
<div class="sidebar" id="sidebar">
   <!-- Logo -->
   <div class="sidebar-logo active">
      <a href="{{ route('dashboard') }}" class="logo logo-normal">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
      <a href="{{ route('dashboard') }}" class="logo logo-white">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
      <a href="{{ route('dashboard')}}" class="logo-small">
         <img src="{{asset('backend/assets/back-img/white-logo.png')}}" alt="Img">
      </a>
   </div>
   <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li class="submenu-open">
               <ul>
                  
                  <li class="active">
                     <a href="{{ route('dashboard') }}">
                        <i class="ti ti-layout-grid fs-16 me-2"></i>
                        <span>Панель управления</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('users') ? 'open' : ''}} submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-layout-grid-add fs-16 me-2"></i>
                        <span>Manage User</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul class="sub-menu" >
                        <li>
                           <a class="" href="{{ route('users.index') }}"> User</a>
                        </li>
                        <li>
                           <a class="" href="{{ route('roles.index') }}">Roles</a>
                        </li>
                        <li>
                           <a class="" href="{{ route('permissions.index') }}">Permissions</a>
                        </li>
                        
                     </ul>
                  </li>

                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-layout-grid-add fs-16 me-2"></i>
                        <span>Управление меню</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('menus.index') }}">Все меню</a></li>
                        <li><a href="{{ route('menus.create') }}">Создать меню</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-brand-apple-arcade fs-16 me-2"></i>
                        <span>Управление страницами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('pages.index') }}">Все страницы</a></li>
                        <li><a href="{{ route('pages.create') }}">Создать страницу</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-file fs-16 me-2"></i>
                        <span>Управление баннерами </span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('manage-banner.index') }}">Баннер</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-award-filled fs-16 me-2"></i>
                        <span>Управление этапами и наградами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li><a href="{{ route('manage-year.index') }}">Год</a></li>
                        <li><a href="{{ route('manage-award-category.index') }}">Категория</a></li>
                        <li><a href="{{ route('manage-awards.index') }}">Добавить достижения и награды</a></li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-news fs-16 me-2"></i>
                        <span>Управление новостями и медиа </span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li>
                        <a href="{{ route('manage-news-media-category.index') }}">
                           Добавить категорию новостей и медиа
                        </a>
                        </li>
                        <li>
                           <a href="{{ route('manage-news-media.index') }}">
                               Добавить новости и медиа
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="submenu">
                     <a href="javascript:void(0);">
                        <i class="ti ti-medicine-syrup fs-16 me-2"></i>
                        <span> Управление лекарствами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul>
                        <li>
                           <a href="{{ route('medicine-category.index') }}">
                             Категория лекарств
                           </a>
                        </li>
                        <li><a href="{{ route('manage-medicine.index') }}">Лекарство</a></li>
                     </ul>
                  </li>
                  

                  

               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
<!-- /Sidebar -->