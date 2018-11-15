<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">Content</li>


        <li class="treeview">
          <a href="{{ route('admin.home')}}">
            <i class="fa fa-home"></i>
          </a>
          </li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i> <span>Posts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="">
              
                
                <li class="active">
                  <a href="{{route('post.index')}}"><i class="fa fa-circle-o"></i>List
                    @if(count($posts) > 0)  
                      <span class="label label-success pull-right">
                          {{count($posts)}}
                      </span></a>
                    @else
                      <span class="label label-success pull-right">
                        empty list
                      </span>
                    @endif
                  </a>
                </li>
                @can('posts.create', Auth::user())
                  <li>
                    <a href="{{route('post.create')}}">
                      <i class="fa fa-dot"></i>
                          Create Post
                    </a>
                  </li>
                @endcan
                @can('posts.update', Auth::user())
                  <li>
                    <a href="{{ route('admin.editing') }}">
                      <i class="fa fa-edit"></i>
                          For Editing
                          @if($forediting > 0)
                            <span class="label label-danger pull-right">
                                {{ $forediting }}
                            </span>
                          @endif
                    </a>
                  </li>
                @endcan
                @can('posts.publish', Auth::user())
                  <li>
                    <a href="{{ route('admin.publishing') }}">
                      <i class="fa fa-file-text-o"></i>
                          For Publishing
                          @if($forpublish > 0)
                            <span class="label label-warning pull-right">
                              {{ $forpublish }}
                            </span>
                          @endif
                    </a>
                  </li>
                @endcan

                <li>
                  <a href="{{ route('admin.published') }}">
                    <i class="fa fa-inbox"></i> 
                        Published
                        @if($publish > 0)
                          <span class="label label-primary pull-right">
                            {{ $publish }}
                          </span>
                        @endif
                  </a>
                </li>
                
                @can('posts.delete', Auth::user())
                  <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                @endcan
              
            </ul>
        </li>

        <li class="treeview">
            <a href="">
              <i class="fa fa-circle-o"></i> <span>Genre</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="">

              {{-- Restrics admin user to access CATEGORY menu sidebar if not permitted --}}
              @can('posts.category', Auth::user())
               <li>
                 <a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> List
                  <span class="label label-success pull-right">
                      {{count($categories)}}
                  </span>
                  </a>
              </li>
              @endcan
              @foreach ($categories as $category)    
                <li><a href="#"><i class="fa fa-dot-circle-o"></i> {{ $category->name }}
                  <span class="label label-primary pull-right"></span>
                </a></li>
              @endforeach
            </ul>
        </li>
            
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                  
                  {{-- Restrics admin user to access TAG menu sidebar if not permitted --}}
                  @can('posts.tag', Auth::user())
                    <li><a href="{{route('tag.index')}}"><i class="fa fa-circle-o"></i>Tags</a></li>
                  @endcan
                  <li><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
                  <li><a href="{{route('permission.index')}}"><i class="fa fa-circle-o"></i> Permissions</a></li>
                  <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> Users</a></li>
              </ul>
            </div>
            <!-- /.box-body -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>