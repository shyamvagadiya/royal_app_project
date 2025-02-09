

                  <li class="nav-item">
                    

                  
                  <li class="nav-item">
                          <a href="{{route('welcome')}}" class="nav-link" aria-expanded="false">
                             <i class="far fa-user nav-icon"></i>
                            <span class="nav-text">


                            @if(Session::has('access_token'))
                                Welcome, {{ Session::get('user_name') }}
                            @endif

                            </span>
                          </a>
                        </li> 
                  </li>
                  <li class="nav-item">
                          <a href="{{route('authors.index')}}" class="nav-link" aria-expanded="false">
                             <i class="far fa-circle nav-icon"></i>
                            <span class="nav-text">Authors</span>
                          </a>
                        </li> 
                  </li>
                  <li class="nav-item">
                          <a href="{{route('books.index')}}" class="nav-link" aria-expanded="false">
                             <i class="far fa-circle nav-icon"></i>
                            <span class="nav-text">Books</span>
                          </a>
                        </li> 
                  </li>
                  <li class="nav-item">
                          <a href="{{route('profile.show')}}" class="nav-link" aria-expanded="false">
                             <i class="far fa-circle nav-icon"></i>
                            <span class="nav-text">Profile</span>
                          </a>
                        </li> 
                  </li>
                  <li class="nav-item">
                          <a href="{{route('logout')}}" class="nav-link" aria-expanded="false">
                             <i class="far fa-circle nav-icon"></i>
                            <span class="nav-text">Logout</span>
                          </a>
                        </li> 
                  </li>
                
                  
                      

                  
                  

                    


                   



                    
                    

                 
              