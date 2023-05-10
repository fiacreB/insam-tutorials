<ul>
    <li class="active"><a href="{{ route('dashboard') }}"><span class="flaticon-puzzle-1"></span>
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
    <li><a href="{{ route('admin.courses.index') }}"><span class="flaticon-add-contact"></span> Formation</a></li>
</ul>
<h4>Examen</h4>
<ul>
    <li><a href="{{ route('admin.tests.loadMarks') }}"><span class="bi bi-file-earmark-person"></span>
            Marks</a></li>
    <li><a href="{{ route('admin.exams.reviewExams') }}"><span class="bi bi-hand-thumbs-up "></span>
            Exam review</a></li>
</ul>
<h4>Bibliothèque</h4>
<ul>
    <li><a href="{{ route('admin.book_categories.index') }}"><span class="bi bi-bookshelf"></span>
            Catégories</a></li>
    <li><a href="{{ route('admin.books.index') }}"><span class="bi bi-book"></span>
            Livres</a></li>
</ul>
<h4>Account</h4>
<ul>

    <li><a href="{{ route('admin.studentsDashboard') }}"><i class="bi bi-person"></i>
            Sutdents</a></li>
    <li><a href="{{ route('admin.store') }}"><i class="bi bi-person-gear"></i>
            Admin</a></li>
    <li><a href="{{ route('admin.settingDashboard', ['user' => Auth::user()->id]) }}"><span
                class="flaticon-settings"></span>
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
