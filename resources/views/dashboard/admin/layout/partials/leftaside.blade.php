<div class="col-sm-12 col-lg-4 col-xl-2 dn-smd pl0">
    <div class="user_board">
        <div class="user_profile">
            <div class="media">
                <div class="media-body">
                    <h4 class="mt-0">Start</h4>
                </div>
            </div>
        </div>
        <div class="dashbord_nav_list">
            <ul>
                <li class="active"><a href="page-dashboard.html"><span class="flaticon-puzzle-1"></span>
                        Dashboard</a></li>
                <li><a href="page-my-courses.html"><span class="flaticon-online-learning"></span>
                        My Courses</a></li>
                <li><a href="page-my-order.html"><span class="flaticon-shopping-bag-1"></span>
                        Order</a></li>
                <li><a href="page-my-message.html"><span class="flaticon-speech-bubble"></span>
                        Messages</a></li>
                <li><a href="page-my-review.html"><span class="flaticon-rating"></span>
                        Reviews</a></li>
                <li><a href="page-my-bookmarks.html"><span class="flaticon-like"></span>
                        Bookmarks</a></li>
                <li><a href="page-my-listing.html"><span class="flaticon-add-contact"></span> Add
                        listing</a></li>
            </ul>
            <h4>Account</h4>
            <ul>
                <li><a href="{{ route('admin.store') }}"><span class="flaticon-settings"></span>
                        Admin</a></li>
                <li><a href="page-my-setting.html"><span class="flaticon-settings"></span>
                        Settings</a></li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><span
                            class="flaticon-logout"></span> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
