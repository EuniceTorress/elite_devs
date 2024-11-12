<style>
    label{
        font-weight: bold;
    }
    .btn {
        border: 2px solid rgba(168, 168, 168, 0.414);
    }

    .btn:hover {
        border: 2px solid rgba(168, 168, 168, 0.414);
    }

    .buttons a {
        text-decoration: none;
        color: #ffffff;
    }

    .card {
        width: 40%;
        height: 212px;
    }

    .card img {
        width: 70%;
        height: auto;
    }

    .up {
        margin-left: 50px;
        margin-top: 10px;
        
    }

    .up .dropdown a {
        color: #000000;
        text-decoration: none;
    }
    @media (max-width: 500px) {
        .card {
            margin-left: 0 !important;
            width: 100%;
            height: 212px;
        }

        .card img {
            width: 65%;
            height: auto;
        }

        .info-cont {
            flex-direction: column;
        }

        .up {
            margin-top: 20px;
        }
    }
</style>

<form id="user-info-cont">
    <h4 class="fw-bold text-center p-5">SIGN UP</h4>
    <div class="row">
        <div class="col-lg-3">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">First Name</label>
                <input type="email" class="form-control" id="exampleInputfirst"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">Middle Name</label>
                <input type="email" class="form-control" id="exampleInputmid" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">last Name</label>
                <input type="email" class="form-control" id="exampleInputlast" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">Suffix Name</label>
                <input type="email" class="form-control" id="exampleInputSuffix"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">Gender</label>
                <input type="email" class="form-control" id="exampleInputSuffix"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                <input type="email" class="form-control" id="exampleInputSuffix"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3 text-center">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"
                    placeholder="DD/MM/YYYY">
            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label">User Nmae</label>
                <input type="email" class="form-control" id="exampleInputUser" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
                <div class="buttons d-flex justify-content-between align-items-center mt-3">
                    <button type="button" class="btn btn-danger"><a href="homepage.html">Back</a></button>
                    <button type="button" class="btn btn-success"><a href="">Submit</a></button>
                </div>
            </div>
        </div>
        <div class="info-cont col-lg-6 mt-3 d-flex">
            <div class="card pt-3">
                <center>
                    <img src="./img/1e99fbaeb36fc3a43d504986f781aeed.jpg" class="card-img-right"
                        alt="Card Image">
                </center>
            </div>
            <div class="up">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <a href="">Upload Photo</a>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Browse Image</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>