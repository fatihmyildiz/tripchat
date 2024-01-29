<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        
          
       
                <li class="menu-title mt-30">
            <span>Applications</span>
        </li>
       
        <li>
            <a href="{{ route('chat',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/chat') ? 'active':'' }}">
                <span class="nav-icon uil uil-chat"></span>
                <span class="menu-text">{{ trans('menu.chat-menu-title') }}</span>
                <span class="badge badge-success menuItem rounded-circle">3</span>
            </a>
        </li>
      
        <li class="has-child {{ Request::is(app()->getLocale().'/applications/user/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/applications/user/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-users-alt"></span>
                <span class="menu-text">{{ trans('menu.user-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('user.member',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/member') ? 'active':'' }}">{{ trans('menu.user-team') }}</a></li>
                <li><a href="{{ route('hotel.grid',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/hotels/team') ? 'active':'' }}">{{ trans('menu.team') }}</a></li>
                <li><a href="{{ route('user.list',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/list') ? 'active':'' }}">{{ trans('menu.user-list') }}</a></li>
                <li><a href="{{ route('user.grid_style',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/grid-style') ? 'active':'' }}">{{ trans('menu.user-grid-style') }}</a></li>
                <li><a href="{{ route('user.group',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/group') ? 'active':'' }}">{{ trans('menu.user-group') }}</a></li>
                <li><a href="{{ route('user.add',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/add') ? 'active':'' }}">{{ trans('menu.user-add') }}</a></li>
                <li><a href="{{ route('user.table',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/user/table') ? 'active':'' }}">{{ trans('menu.user-table') }}</a></li>
            </ul>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/applications/contact/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/applications/contact/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-at"></span>
                <span class="menu-text">{{ trans('menu.contact-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a class="{{ Request::is(app()->getLocale().'/applications/contact/grid') ? 'active':'' }}" href="{{ route('contact.grid',app()->getLocale()) }}">{{ trans('menu.contact-grid') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/applications/contact/list') ? 'active':'' }}" href="{{ route('contact.list',app()->getLocale()) }}">{{ trans('menu.contact-list') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/applications/contact/create') ? 'active':'' }}" href="{{ route('contact.create',app()->getLocale()) }}">{{ trans('menu.contact-create') }}</a></li>
            </ul>
        </li>

        
       
      
        <li>
            <a href="{{ route('filemanager',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/filemanager') ? 'active':'' }}">
                <span class="nav-icon uil uil-repeat"></span>
                <span class="menu-text">{{ trans('menu.filemanager-menu-title') }}</span>
            </a>
        </li>
       
        
        <li class="has-child {{ Request::is(app()->getLocale().'/applications/social/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/applications/social/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-apps"></span>
                <span class="menu-text">{{ trans('menu.social-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li class="nav-item"><a href="{{ route('social.profile',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/social/profile') ? 'active':'' }}">{{ trans('menu.social-profile') }}</a></li>
                <li><a href="{{ route('social.profile_settings',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/social/profile-settings') ? 'active':'' }}">{{ trans('menu.social-profile-setting') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link {{ Request::is(app()->getLocale().'/applications/social/timeline') ? 'active':'' }}" href="{{ route('social.timeline',app()->getLocale()) }}">{{ trans('menu.social-timeline') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is(app()->getLocale().'/applications/social/activity') ? 'active':'' }}" href="{{ route('social.activity',app()->getLocale()) }}">{{ trans('menu.social-activity') }}</a></li> -->
            </ul>
        </li>
      
  
        
        <li class="menu-title mt-30">
            <span>Features</span>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/ui/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/ui/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-layers"></span>
                <span class="menu-text">{{ trans('menu.ui-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/alert') ? 'active':'' }}" href="{{ route('ui.alert',app()->getLocale()) }}">{{ trans('menu.ui-alert') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/avatar') ? 'active':'' }}" href="{{ route('ui.avatar',app()->getLocale()) }}">{{ trans('menu.ui-avatar') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/badge') ? 'active':'' }}" href="{{ route('ui.badge',app()->getLocale()) }}">{{ trans('menu.ui-badge') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/breadcrumps') ? 'active':'' }}" href="{{ route('ui.breadcrumps',app()->getLocale()) }}">{{ trans('menu.ui-breadcrumb') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/button') ? 'active':'' }}" href="{{ route('ui.button',app()->getLocale()) }}">{{ trans('menu.ui-button') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/card') ? 'active':'' }}" href="{{ route('ui.card',app()->getLocale()) }}">{{ trans('menu.ui-card') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/carousel') ? 'active':'' }}" href="{{ route('ui.carousel',app()->getLocale()) }}">{{ trans('menu.ui-carousel') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/checkbox') ? 'active':'' }}" href="{{ route('ui.checkbox',app()->getLocale()) }}">{{ trans('menu.ui-checkbox') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/collapse') ? 'active':'' }}" href="{{ route('ui.collapse',app()->getLocale()) }}">{{ trans('menu.ui-collapse') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/comments') ? 'active':'' }}" href="{{ route('ui.comments',app()->getLocale()) }}">{{ trans('menu.ui-comment') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/dashboard-base') ? 'active':'' }}" href="{{ route('ui.dashboard_base',app()->getLocale()) }}">{{ trans('menu.ui-dashboard-base') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/datepicker') ? 'active':'' }}" href="{{ route('ui.datepicker',app()->getLocale()) }}">{{ trans('menu.ui-date-picker') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/drawer') ? 'active':'' }}" href="{{ route('ui.drawer',app()->getLocale()) }}">{{ trans('menu.ui-drawer') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/drag-drop') ? 'active':'' }}" href="{{ route('ui.drag_drop',app()->getLocale()) }}">{{ trans('menu.ui-drag-drop') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/dropdown') ? 'active':'' }}" href="{{ route('ui.dropdown',app()->getLocale()) }}">{{ trans('menu.ui-dropdown') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/empty') ? 'active':'' }}" href="{{ route('ui.empty',app()->getLocale()) }}">{{ trans('menu.ui-empty') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/grid') ? 'active':'' }}" href="{{ route('ui.grid',app()->getLocale()) }}">{{ trans('menu.ui-grid') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/input') ? 'active':'' }}" href="{{ route('ui.input',app()->getLocale()) }}">{{ trans('menu.ui-input') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/list') ? 'active':'' }}" href="{{ route('ui.list',app()->getLocale()) }}">{{ trans('menu.ui-list') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/menu') ? 'active':'' }}" href="{{ route('ui.menu',app()->getLocale()) }}">{{ trans('menu.ui-menu') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/message') ? 'active':'' }}" href="{{ route('ui.message',app()->getLocale()) }}">{{ trans('menu.ui-message') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/modals') ? 'active':'' }}" href="{{ route('ui.modals',app()->getLocale()) }}">{{ trans('menu.ui-modal') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/notification') ? 'active':'' }}" href="{{ route('ui.notification',app()->getLocale()) }}">{{ trans('menu.ui-notification') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/page-header') ? 'active':'' }}" href="{{ route('ui.page_header',app()->getLocale()) }}">{{ trans('menu.ui-page-header') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/pagination') ? 'active':'' }}" href="{{ route('ui.pagination',app()->getLocale()) }}">{{ trans('menu.ui-pagination') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/progress') ? 'active':'' }}" href="{{ route('ui.progress',app()->getLocale()) }}">{{ trans('menu.ui-progress') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/radio') ? 'active':'' }}" href="{{ route('ui.radio',app()->getLocale()) }}">{{ trans('menu.ui-radio') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/rate') ? 'active':'' }}" href="{{ route('ui.rate',app()->getLocale()) }}">{{ trans('menu.ui-rate') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/result') ? 'active':'' }}" href="{{ route('ui.result',app()->getLocale()) }}">{{ trans('menu.ui-result') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/select') ? 'active':'' }}" href="{{ route('ui.select',app()->getLocale()) }}">{{ trans('menu.ui-select') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/skeleton') ? 'active':'' }}" href="{{ route('ui.skeleton',app()->getLocale()) }}">{{ trans('menu.ui-skeleton') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/slider') ? 'active':'' }}" href="{{ route('ui.slider',app()->getLocale()) }}">{{ trans('menu.ui-slider') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/spinner') ? 'active':'' }}" href="{{ route('ui.spinner',app()->getLocale()) }}">{{ trans('menu.ui-spinner') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/statistic') ? 'active':'' }}" href="{{ route('ui.statistic',app()->getLocale()) }}">{{ trans('menu.ui-statistic') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/steps') ? 'active':'' }}" href="{{ route('ui.steps',app()->getLocale()) }}">{{ trans('menu.ui-step') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/switch') ? 'active':'' }}" href="{{ route('ui.switch',app()->getLocale()) }}">{{ trans('menu.ui-switch') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/tab') ? 'active':'' }}" href="{{ route('ui.tab',app()->getLocale()) }}">{{ trans('menu.ui-tab') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/tags') ? 'active':'' }}" href="{{ route('ui.tags',app()->getLocale()) }}">{{ trans('menu.ui-tag') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/timeline') ? 'active':'' }}" href="{{ route('ui.timeline',app()->getLocale()) }}">{{ trans('menu.ui-timeline') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/timeline2') ? 'active':'' }}" href="{{ route('ui.timeline2',app()->getLocale()) }}">{{ trans('menu.ui-timeline2') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/timeline3') ? 'active':'' }}" href="{{ route('ui.timeline3',app()->getLocale()) }}">{{ trans('menu.ui-timeline3') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/timepicker') ? 'active':'' }}" href="{{ route('ui.timepicker',app()->getLocale()) }}">{{ trans('menu.ui-time-picker') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/ui/uploads') ? 'active':'' }}" href="{{ route('ui.uploads',app()->getLocale()) }}">{{ trans('menu.ui-upload') }}</a></li>
            </ul>
        </li>
      
        <li class="has-child {{ Request::is(app()->getLocale().'/form/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/form/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-keyhole-circle"></span>
                <span class="menu-text">{{ trans('menu.form-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a class="{{ Request::is(app()->getLocale().'/form/basic') ? 'active':'' }}" href="{{ route('form.basic',app()->getLocale()) }}">{{ trans('menu.form-basic') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/form/layout') ? 'active':'' }}" href="{{ route('form.layout',app()->getLocale()) }}">{{ trans('menu.form-layout') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/form/element') ? 'active':'' }}" href="{{ route('form.element',app()->getLocale()) }}">{{ trans('menu.form-element') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/form/component') ? 'active':'' }}" href="{{ route('form.component',app()->getLocale()) }}">{{ trans('menu.form-component') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/form/validation') ? 'active':'' }}" href="{{ route('form.validation',app()->getLocale()) }}">{{ trans('menu.form-validation') }}</a></li>
            </ul>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/widget/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/widget/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-server"></span>
                <span class="menu-text">{{ trans('menu.widget-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a class="{{ Request::is(app()->getLocale().'/widget/chart') ? 'active':'' }}" href="{{ route('widget.chart',app()->getLocale()) }}">{{ trans('menu.widget-chart') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/widget/mixed') ? 'active':'' }}" href="{{ route('widget.mixed',app()->getLocale()) }}">{{ trans('menu.widget-mixed') }}</a></li>
                <li><a class="{{ Request::is(app()->getLocale().'/widget/card') ? 'active':'' }}" href="{{ route('widget.card',app()->getLocale()) }}">{{ trans('menu.widget-card') }}</a></li>
            </ul>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/wizard/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/wizard/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-square"></span>
                <span class="menu-text">{{ trans('menu.wizard-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('wizard.one',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/wizard/one') ? 'active':'' }}">{{ trans('menu.wizard-one') }}</a></li>
                <li><a href="{{ route('wizard.two',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/wizard/two') ? 'active':'' }}">{{ trans('menu.wizard-two') }}</a></li>
                <li><a href="{{ route('wizard.three',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/wizard/three') ? 'active':'' }}">{{ trans('menu.wizard-three') }}</a></li>
                <li><a href="{{ route('wizard.four',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/wizard/four') ? 'active':'' }}">{{ trans('menu.wizard-four') }}</a></li>
                <li><a href="{{ route('wizard.five',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/wizard/five') ? 'active':'' }}">{{ trans('menu.wizard-five') }}</a></li>
            </ul>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/icon/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/icon/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-grid"></span>
                <span class="menu-text">{{ trans('menu.icon-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('icon.unicon',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/icon/unicon') ? 'active':'' }}">{{ trans('menu.icon-unicon') }}</a></li>
                <li><a href="{{ route('icon.awesome',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/icon/awesome') ? 'active':'' }}">{{ trans('menu.icon-awesome') }}</a></li>
                <li><a href="{{ route('icon.lineawesome',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/icon/lineawesome') ? 'active':'' }}">{{ trans('menu.icon-line') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('editor',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/editor') ? 'active':'' }}">
                <span class="nav-icon uil uil-edit"></span>
                <span class="menu-text">{{ trans('menu.editor-menu-title') }}</span>
            </a>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/map/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/map/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-map"></span>
                <span class="menu-text">{{ trans('menu.map-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('map.google',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/map/google') ? 'active':'' }}">{{ trans('menu.map-google') }}</a></li>
                <li><a href="{{ route('map.leaflet',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/map/leaflet') ? 'active':'' }}">{{ trans('menu.map-leaflet') }}</a></li>
                <li><a href="{{ route('map.vector',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/map/vector') ? 'active':'' }}">{{ trans('menu.map-vector') }}</a></li>
            </ul>
        </li>
        <li class="menu-title mt-30">
            <span>Pages</span>
        </li>
        <li class="has-child {{ Request::is(app()->getLocale().'/pages/gallery/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/pages/gallery/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-images"></span>
                <span class="menu-text">{{ trans('menu.gallery-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('pages.gallery1',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/gallery/gallery1') ? 'active':'' }}">{{ trans('menu.gallery-one') }}</a></li>
                <li>
                    <a href="{{ route('pages.gallery2',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/gallery/gallery2') ? 'active':'' }}">{{ trans('menu.gallery-two') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('pages.pricing',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/pricing') ? 'active':'' }}">
                <span class="nav-icon uil uil-bill"></span>
                <span class="menu-text">{{ trans('menu.pricing-menu-title') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pages.banner',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/banner') ? 'active':'' }}">
                <span class="nav-icon uil uil-thumbs-up"></span>
                <span class="menu-text">{{ trans('menu.banner-menu-title') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pages.testimonial',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/testimonial') ? 'active':'' }}">
                <span class="nav-icon uil uil-book-open"></span>
                <span class="menu-text">{{ trans('menu.testimonial-menu-title') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pages.faq',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/faq') ? 'active':'' }}">
                <span class="nav-icon uil uil-question-circle"></span>
                <span class="menu-text">{{ trans('menu.faq-menu-title') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pages.blank',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/blank') ? 'active':'' }}">
                <span class="nav-icon uil uil-circle"></span>
                <span class="menu-text">{{ trans('menu.blank-menu-title') }}</span>
            </a>
        </li>
     
       
        <li class="has-child {{ Request::is(app()->getLocale().'/pages/blog/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/pages/blog/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-images"></span>
                <span class="menu-text">{{ trans('menu.blog-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('pages.blog.one',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/blog/one') ? 'active':'' }}">{{ trans('menu.blog-style-one') }}</a></li>
                <li><a href="{{ route('pages.blog.two',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/blog/two') ? 'active':'' }}">{{ trans('menu.blog-style-two') }}</a></li>
                <li><a href="{{ route('pages.blog.three',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/blog/three') ? 'active':'' }}">{{ trans('menu.blog-style-three') }}</a></li>
                <li><a href="{{ route('pages.blog.detail',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/blog/detail') ? 'active':'' }}">{{ trans('menu.blog-detail') }}</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('pages.terms',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/terms-and-condition') ? 'active':'' }}">
                <span class="nav-icon uil uil-question-circle"></span>
                <span class="menu-text">{{ trans('menu.terms-menu-title') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pages.maintenance',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/maintenance') ? 'active':'' }}">
                <span class="nav-icon uil uil-airplay"></span>
                <span class="menu-text">{{ trans('menu.maintenance-menu-title') }}</span>
            </a>
        </li>
        <!-- <li>
            <a href="{{ route('pages.setting',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/setting') ? 'active':'' }}">
                <span class="nav-icon uil uil-setting"></span>
                <span class="menu-text">{{ trans('menu.setting-menu-title') }}</span>
            </a>
        </li> -->
        <li>
            <a href="{{ route('pages.404',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/404') ? 'active':'' }}">
                <span class="nav-icon uil uil-exclamation-triangle"></span>
                <span class="menu-text">{{ trans('menu.not-found-menu-title') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pages.coming_soon',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/pages/coming-soon') ? 'active':'' }}">
                <span class="nav-icon uil uil-sync"></span>
                <span class="menu-text">{{ trans('menu.coming-soon-menu-title') }}</span>
            </a>
        </li>
        @if(Request::is(app()->getLocale().'/dashboards/demo-five'))
            <div class="card sidebar__feature shadow-none bg-transparent border-0 py-sm-50 px-sm-35 text-center">
                <div class="px-15 mb-sm-35 mb-20">
                    <img src="{{ asset('assets/img/sidebar-feature.png') }}" alt="book">
                </div>
                <h3>Get More Feature by Upgrading</h3>
                <button type="button" class="btn btn-primary inline-flex mt-sm-35 mt-20">
                    Go Premium
                </button>
            </div>
        @endif
    </ul>
</div>
