<!doctype html>
<html lang="en">

<head>
    <title>Video Uploader</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm border-bottom">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <h3>Youtube Video Uploader</h3>
                </ul>

            </div>
        </nav>

    </header>
    <main>
        @if (session('status'))
        <p>{{ session('status') }}</p>
        @endif
        <div class="container m-5 p-5">
            <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="title" class="col-2 col-form-label">Title</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Tile" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-2 col-form-label">Description</label>
                    <div class="col-10">
                        <textarea type="text" class="form-control" name="description" id="description"
                            placeholder="Discription"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-2 col-form-label">Upload video</label>
                    <div class="col-10">
                        <input type="file" class="form-control" name="video" id="video" placeholder="Upload your video"
                            aria-describedby="fileHelpId" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>

            </form>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>