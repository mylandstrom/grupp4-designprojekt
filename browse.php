<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Portfolios</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<!-- En container som innehåller en rubrik för sidan.--->

<body>
    <div class="browse-page">
        <div class="container mt-5">
            <h2 class="mb-4">Browse portfolios</h2>
            <div class="d-flex justify-content-between mb-4">
            </div>

            <!-- En container som innehåller en sökfunktion och en knapp för att filtrera resultaten.--->
            <div class="d-flex mb-4">
                <input class="form-control flex-grow-1 me-3" type="search" placeholder="Search designers">

                <!-- Dropdown istället för vanlig knapp -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#">Graphic Designers</a></li>
                        <li><a class="dropdown-item" href="#">UI/UX Designers</a></li>
                        <li><a class="dropdown-item" href="#">Illustrators</a></li>
                        <li><a class="dropdown-item" href="#">All</a></li>
                    </ul>
                </div>
            </div>

            <!-- En kort beskrivning av varje designer i en kort, med en bild, namn, yrke och en knapp för att kontakta dem. -->
            <div class="card mb-5 p-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3">
                    <div>
                        <h5 class="mb-0">Jane Doe</h5>
                        <small class="text-muted">UI/UX Designer</small>
                    </div>
                    <button class="btn btn-sm btn-dark ms-auto">Contact</button>
                </div>

                <!-- En bootstrap karusell -->
                <div id="portfolioSlider1" class="carousel slide mt-3">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                </div>

                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row">

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300/ff4444" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300/00C851" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300/33b5e5" class="d-block w-100 rounded">
                                </div>

                                <div class="col-md-3">
                                    <img src="https://via.placeholder.com/300/2BBBAD" class="d-block w-100 rounded">
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Knappar för att navigera mellan karusellens slides. -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <!-- En kort beskrivning av varje designer i en kort, med en bild, namn, yrke och en knapp för att kontakta dem. -->
                <div class="card mb-5 p-3">
                    <div class="d-flex align-items-center mb-4">
                        <img src="https://via.placeholder.com/50" class="rounded-circle me-3">
                        <div>
                            <h5 class="mb-0">Jane Doe</h5>
                            <small class="text-muted">UI/UX Designer</small>
                        </div>
                        <button class="btn btn-sm btn-dark ms-auto">Contact</button>
                    </div>

                    <!-- En bootstrap karusell -->
                    <div id="portfolioSlider1" class="carousel slide mt-3">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                    </div>

                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300/ff4444" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300/00C851" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300/33b5e5" class="d-block w-100 rounded">
                                    </div>

                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/300/2BBBAD" class="d-block w-100 rounded">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Knappar för att navigera mellan karusellens slides. -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <!-- En kort beskrivning av varje designer i en kort, med en bild, namn, yrke och en knapp för att kontakta dem. -->
                    <div class="card mb-5 p-3">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3">
                            <div>
                                <h5 class="mb-0">Jane Doe</h5>
                                <small class="text-muted">UI/UX Designer</small>
                            </div>
                            <button class="btn btn-sm btn-dark ms-auto">Contact</button>
                        </div>

                        <!-- En bootstrap karusell -->
                        <div id="portfolioSlider1" class="carousel slide mt-3">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300" class="d-block w-100 rounded">
                                        </div>

                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300/ff4444" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300/00C851" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300/33b5e5" class="d-block w-100 rounded">
                                        </div>

                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/300/2BBBAD" class="d-block w-100 rounded">
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- Knappar för att navigera mellan karusellens slides. -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#portfolioSlider1" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>

                        <!-- Script till Bootstrap 5.3.2, som behövs för att karusellen ska fungera. -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>