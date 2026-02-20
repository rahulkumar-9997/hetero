<!-- Sidebar -->
<!-- {{ auth()->user()->getRoleNames() }} -->
<!-- @foreach(auth()->user()->getAllPermissions() as $permission)
    {{ $permission->name }} <br>
@endforeach -->
@php
function isActiveRoute($routes)
{
$routes = (array) $routes;
foreach ($routes as $route) {
if (request()->routeIs($route)) {
return true;
}
}
return false;
}

function isActiveUrl($patterns)
{
$patterns = (array) $patterns;
foreach ($patterns as $p) {
if (request()->is($p)) {
return true;
}
}
return false;
}
@endphp
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
                  <li class="{{ isActiveRoute('dashboard') ? 'active' : '' }}">
                     <a href="{{ route('dashboard') }}">
                        <i class="ti ti-layout-grid fs-16 me-2"></i>
                        <span>Панель управления</span>
                     </a>
                  </li>
                  <li class="submenu {{ isActiveUrl(['users*','roles*','permissions*']) ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-layout-grid-add fs-16 me-2"></i>
                        <!-- <span>Manage User</span> -->
                        <span>Управление пользователем</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul class="sub-menu" style="display: {{ isActiveUrl(['users*','roles*','permissions*']) ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('users.*') ? 'active' : '' }}">
                           <!-- <a class="" href="{{ route('users.index') }}"> User</a> -->
                           <a class="" href="{{ route('users.index') }}"> Пользователь</a>
                        </li>
                        <li class="{{ isActiveRoute('roles.*') ? 'active' : '' }}">
                           <!-- <a class="" href="{{ route('roles.index') }}">Roles</a> -->
                           <a class="" href="{{ route('roles.index') }}">Роли</a>
                        </li>
                        @if(auth()->user()->getRoleNames()->contains('Admin'))
                        <li class="{{ isActiveRoute('permissions.*') ? 'active' : '' }}">
                           <!-- <a class="" href="{{ route('permissions.index') }}">Permissions</a> -->
                           <a class="" href="{{ route('permissions.index') }}">Права доступа</a>
                        </li>
                        @endif

                     </ul>
                  </li>

                  <li class="submenu {{ isActiveUrl('menus*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-layout-grid-add fs-16 me-2"></i>
                        <span>Управление меню</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('menus*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('menus.index') ? 'active' : '' }}">
                           <a href="{{ route('menus.index') }}">Все меню</a>
                        </li>
                        <li class="{{ isActiveRoute('menus.create') ? 'active' : '' }}"><a
                              href="{{ route('menus.create') }}">Создать меню</a>
                        </li>
                     </ul>
                  </li>
                  <li class="submenu {{ isActiveUrl('pages*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-brand-apple-arcade fs-16 me-2"></i>
                        <span>Управление страницами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('pages*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('pages.index') ? 'active' : '' }}">
                           <a href="{{ route('pages.index') }}">Все страницы</a>
                        </li>
                        <li class="{{ isActiveRoute('pages.create') ? 'active' : '' }}">
                           <a href="{{ route('pages.create') }}">Создать страницу</a>
                        </li>
                     </ul>
                  </li>
                  <li class="submenu {{ isActiveUrl('manage-banner*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-file fs-16 me-2"></i>
                        <span>Управление баннерами </span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('manage-banner*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('manage-banner.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-banner.index') }}">Баннер</a>
                        </li>
                     </ul>
                  </li>
                  <li
                     class="submenu {{ isActiveUrl('manage-year*','manage-award-category*','manage-awards*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-award-filled fs-16 me-2"></i>
                        <span>Управление этапами и наградами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('manage-year*','manage-award-category*','manage-awards*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('manage-year.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-year.index') }}">Год</a>
                        </li>
                        <li class="{{ isActiveRoute('manage-award-category.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-award-category.index') }}">Категория</a>
                        </li>
                        <li class="{{ isActiveRoute('manage-awards.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-awards.index') }}">Добавить достижения и награды</a>
                        </li>
                     </ul>
                  </li>
                  <li
                     class="submenu {{ isActiveUrl('manage-news-media*','manage-news-media-category*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-news fs-16 me-2"></i>
                        <span>Управление новостями и медиа </span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('manage-news-media*','manage-news-media-category*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('manage-news-media-category.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-news-media-category.index') }}">
                              Добавить категорию новостей и медиа
                           </a>
                        </li>
                        <li class="{{ isActiveRoute('manage-news-media.index') ? 'active' : '' }}">
                           <a href="{{ route('manage-news-media.index') }}">
                              Добавить новости и медиа
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="submenu {{ isActiveUrl('manage-event*','manage-event-category*') ? 'open' : '' }}">
                     <a href="javascript:void(0);">
                        <i class="ti ti-medicine-syrup fs-16 me-2"></i>
                        <span> Управление лекарствами</span>
                        <span class="menu-arrow"></span>
                     </a>
                     <ul style="display: {{ isActiveUrl('manage-event*','manage-event-category*') ? 'block' : 'none' }};">
                        <li class="{{ isActiveRoute('medicine-category.index') ? 'active' : '' }}">
                           <a href="{{ route('medicine-category.index') }}">
                              Категория лекарств
                           </a>
                        </li>
                        <li class="{{ isActiveRoute('manage-medicine.index') ? 'active' : '' }}">
                           <a
                              href="{{ route('manage-medicine.index') }}">Лекарство</a>
                        </li>
                     </ul>
                  </li>

               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
<!-- /Sidebar -->