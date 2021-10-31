<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="Expires" content="0">



    <title>API Searcher</title>



    <link rel="stylesheet" href="./resources/css/styles.css">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Font awesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

<body>



<div class="container-fluid">

<div class="container-fluid web-banner" style="background: url(https://www.xmple.com/wallpaper/blue-green-gradient-linear-1920x1080-c2-1e90ff-adff2f-a-120-f-14.svg) no-repeat center center fixed;">

    <div class="web-banner-content d-flex flex-column justify-content-center align-items-center">

        <div class="row col-12 col-md-10 col-lg-8">

            <div class="col-12 d-flex flex-column align-items-center">

    

                <div class="col-12 py-4 text-center text-white">

                    <h1>API Searcher</h1>

                </div>

                <div class="col-12 search-container">

                    <div class="d-flex align-items-center">

                        <select id="search-option" class="search-option">

                            <option default value="all">All</option>

                            <option value="tvShow">TV Shows</option>

                            <option value="movie">Movies</option>

                            <option value="music">Music</option>

                            <option value="name">Names</option>

                        </select>

                        <input type="text" id="search-input" class="search-input" autocomplete="off" placeholder="Search content">

                    </div>

                    <div class="search-results ">

                        <div id="search-result-list">

                            <template id="template">

                                <li>

                                    <a target="__blank"></a>

                                </li>

                            </template>

                        </div>

                        <div class="col d-flex justify-content-center">

                            <div id="loader" class="spinner"></div>

                            <div id="error"></div>

                        </div>

                    </div>

                    <div class="icon">

                        <i class="fas fa-search"></i>

                    </div>



                </div>

                

            </div>

        </div>

    </div>

</div>



<div class="container" style="margin-top: 4rem;">

    <div class="row flex-column flex-md-row justify-content-between justify-content-md-around align-items-center">

        <div class="col d-flex flex-column justify-content-center align-items-center">

            <h3>Getting started</h3>

            <p class="text-center">API Searcher is an API that centralizes other search services so that whoever consumes the service has a single endpoint where they place their search criteria and this API performs searches in other services.</p>

            <a href="https://github.com/ssvalen/APISearcher/blob/main/README.md" target="__blank" class="btn btn-primary">Get started</a>

        </div>

        <div class="col d-flex flex-column justify-content-center align-items-center my-4 my-md-0">

            <h3>Troubleshooting</h3>

            <p class="text-center">Find solutions to common issues, general troubleshooting, configuration issues.</p>

            <a href="https://github.com/ssvalen/APISearcher/blob/main/README.md#soluci%C3%B3n-de-problemas" target="__blank" class="btn btn-primary">Find solutions</a>

        </div>

    </div>

</div>





<script src="./resources/js/App.js"></script>

<script>



    const app = new App(),
    searchContainer = document.querySelector('.search-container'),
    searchOptionSelector = document.querySelector('.search-option'),
    inputBox = document.querySelector('.search-input'),
    inputIcon = document.querySelector('icon'),
    resultsBox = document.querySelector('.search-results');

    

    let d = document,

    $template = document.getElementById('template').content,
    $fragment = document.createDocumentFragment();



        d.addEventListener('keypress', (e) => {

            if(e.target.matches('#search-input')) {



                if(e.key === 'Enter' && e.target.getAttribute('processing') !== 'true') {


                    let searchResultList = document.getElementById('search-result-list');

                    if(searchResultList && searchResultList.children.length > 0) searchResultList.textContent = '';



                    let error = document.getElementById('error')

                    if(error) error.textContent = '';

                    searchContainer.classList.add('loading');

                    e.target.setAttribute('processing', 'true'); 



                    // Get data from API

                    let result = app.fetchData(e.target.value.toLowerCase(), searchOptionSelector.value);

                    result.then(data => {

                        // Checks if there is any error
 
                        if(data == 404 || data == 405 || data == undefined) {

                            

                            error.classList.add('error');

                            error.textContent = 'No records found.'

                            resultsBox.appendChild(error);

                            e.target.setAttribute('processing', 'false');



                        }

                        else return data;

                    }).then(data => {

                        searchContainer.classList.remove('loading');
                        searchContainer.classList.add('active');

                        let shows = [],
                        iTunesMovies = [],
                        songs = [],
                        personList = [];

                        if(data.mediaType.toLowerCase() === 'tvshow' || data.mediaType.toLowerCase() === 'all') {

                            let tvShows = data.searchResults.tvShows;

                            if(tvShows !== undefined) {

                                tvShows.forEach(tvShow => {



                                    let searchSource = tvShow.searchSource;

                                    if(searchSource.toLowerCase() === 'tvmaze') {

                                        shows.push({

                                            name: tvShow.show.name,
                                            url: tvShow.show.url,   
                                            source: searchSource

                                        });

                                    }

                                    if(searchSource.toLowerCase() === 'itunes') {

                                        shows.push(app.iTunesSource(movie, searchSource));

                                    }

                                });

                                shows.forEach(show => {

                                    app.renderTemplate($template, $fragment, show.name, show.url, show.source);

                                });

                            }



                        }

                        if(data.mediaType.toLowerCase() === 'movie' || data.mediaType.toLowerCase() === 'all') {



                            let movies = data.searchResults.movies;

                            if(movies !== undefined) {


                                movies.forEach(movie => {

                                    let searchSource = movie.searchSource;
                                    iTunesMovies.push(app.iTunesSource(movie, searchSource))

                                });



                                iTunesMovies.forEach(movie => {

                                    app.renderTemplate($template, $fragment, movie.name, movie.url, movie.source);

                                });
                            }



                        }

                        if(data.mediaType.toLowerCase() === 'music' || data.mediaType.toLowerCase() === 'all') {

                            let musicData = data.searchResults.music;

                            musicData.forEach(music => {

                                let searchSource = music.searchSource;

                                songs.push(app.iTunesSource(music, searchSource));

                            });



                            songs.forEach(song => {

                                app.renderTemplate($template, $fragment, song.name, song.url, song.source);

                            });

                        }

                        if(data.mediaType.toLowerCase() === 'name' || data.mediaType.toLowerCase() === 'all') {

                            if(data.searchResults.namesList !== undefined) {

                                let persons = data.searchResults.namesList;

                                if(persons.length > 1) {

                                    persons.forEach(person => {

                                        personList.push(person)

                                    });

                                } else personList.push(persons);



                                personList.forEach(person => {

                                    app.renderTemplate($template, $fragment, `${person.Name}`, '', 'NameFinder API');

                                });

                            }

                        }

                        searchResultList.appendChild($fragment);        

                        e.target.setAttribute('processing', 'false');

                    });





                } 

            }

        })



</script>



        







<!-- End of container-fluid -->

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>