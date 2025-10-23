<div class="container mt-1 p-1 rounded-3 text-end bg-dark">
    <span class="text-light"><?= $_SESSION['user']['firstname'] ?></span>
    <a class="btn btn-danger btn-sm ms-2" href="?route=logout">Logout</a>
</div>
<nav class="container mt-3 p-2 border rounded-3 shadow-sm bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="logo mt-1 mb-1">ticketShare</h2>
        </div>
        <div class="col text-end btn-gruop" role="group">
            <a href="?route=home" class="btn btn-light" style="font-weight: 500;">Home</a>

            <div class="btn-group">
                <a href="?route=offer" class="btn btn-light" style="font-weight: 500;">Offer</a>
                <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?route=my-offers">My Offers</a></li>
                </ul>
            </div>

            <a href="?route=search" class="btn btn-light" style="font-weight: 500;">Search</a>
        </div>
    </div>
</nav>