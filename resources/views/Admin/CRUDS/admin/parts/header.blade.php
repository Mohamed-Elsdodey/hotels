<span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                 src="{{get_file(auth()->guard('admin')->user()->image)}}"
                                 alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{auth()->guard('admin')->user()->name}}</span>
                                <span
                                    class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{auth()->guard('admin')->user()->business_name}}</span>
                            </span>
                        </span>  </span>
