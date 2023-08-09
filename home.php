<?php
    include './partials/dbConnect.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ./login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Music for everyone</title>
    <link rel="shortcut icon" href="img/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="master.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://kit.fontawesome.com/a165e4dd2f.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- =========== CREATE PLAYLIST MODAL ============== -->
    <div class="createPlaylistModal" id="createPlaylistModal">
        <i class="fas fa-times" id="createPlaylistCloseBtn"></i>
        <div>
            <input type="text" id="createPlaylistTitle" placeholder="Playlist Name">
            <button id="createPlaylistBtn">Create</button>
        </div>
    </div>

    <!-- ================= CHOOSE PLAYLIST MODAL ================ -->
    <div class="choosePlaylistModal" id="choosePlaylistModal">
        <i class="fas fa-times" id="choosePlaylistCloseBtn"></i>
        <div>
            <select id="selectPlaylist" name="playlist_option" onClick="updateSelectPlaylist(event)">
                <?php
                    $sql = "SELECT p.* FROM playlists p JOIN playlist_user pu ON p.id = pu.playlist_id WHERE pu.user_id ='$user_id'";
                    $result = mysqli_query($conn, $sql);
                    while($row=mysqli_fetch_assoc($result)){
                        echo '<option value='.$row['id'].'>'.$row['title'].'</option>';
                    }
                ?>
            </select>
            <button id="addToPlaylistBtn">Add to Playlist</button>
        </div>
    </div>

    <nav>
        <div class="logo">
            <a href="home.php">
                <img src="img/icons/purple-play-button.png" alt="">
                Musicly
            </a>
        </div>
        <div class="userAccount">
            <div class="accountIcon">
                <i class="fas fa-user"></i>
                <?php
                    $userQry = "SELECT * FROM users WHERE id='$user_id'";
                    $userResult = mysqli_query($conn, $userQry);
                    $userRow = mysqli_fetch_assoc($userResult);
                    $fname = $userRow['fname'];
                    $lname = $userRow['lname'];
                ?>
                <span id="userName"><?php echo $fname.' '.$lname ?></span>
            </div>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <main>
        <div class="sidebar">
            <div class="sidebarHeader">
                <a class="main-tabs headerItem active" id="homeBtn" href="#tab1">
                    <i class="fas fa-home" href="#tab1"></i>
                    Home
                </a>
                <a class="main-tabs headerItem" id="searchBtn" href="#tab2">
                    <i class="fas fa-search" href="#tab2"></i>
                    Search
                </a>
            </div>
            <div class="playlist">
                <div class="playlistHeader">
                    <div class="headerItem">
                        <i class="fas fa-list"></i>
                        <span>Your Playlists</span>
                    </div>
                    <div class="headerItem">
                        <i class="fas fa-plus" id="newPlaylistBtn"></i>
                    </div>
                </div>
                <div class="playlistItems">
                    <?php
                        $sql = "SELECT p.* FROM playlists p JOIN playlist_user pu ON p.id = pu.playlist_id WHERE pu.user_id ='$user_id'";
                        $result = mysqli_query($conn, $sql);
                        $count = 3;
                        while($row=mysqli_fetch_assoc($result)){
                            echo '
                                <a class="playlist-tabs playlistItem" href="#tab'.$count.'">
                                    <img href="#tab'.$count.'" src="'.$row['cover'].'" alt="">
                                    '.$row['title'].'
                                </a>
                            ';
                            $count++;
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="main-tab-content contentItem active" id="tab1">
                <div class="searchContentResult">
                    <?php
                        // POPULATE SONG ITEMS
                        $songUrl = "";
                        $sql = "SELECT * FROM tracks";
                        $result = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                            $qry1 = "SELECT * FROM artist_track where track_id='".$row['id']."'";
                            $result1 = mysqli_query($conn, $qry1);
                            $row1=mysqli_fetch_assoc($result1);
                            $artist_id = $row1['artist_id'];

                            $qry2 = "SELECT * FROM artists where id='$artist_id'";
                            $result2 = mysqli_query($conn, $qry2);
                            $row2=mysqli_fetch_assoc($result2);
                            $artist_name = $row2['name'];
                            
                            $songUrl = $row['url'];
                            $currSong = $row['title'];
                            $currArtist = $artist_name;
                            $currCover = $row['cover'];
                            $currSongId = $row['id'];
                            echo '
                                <div class="searchResultItem" onClick="loadMusic(\'' . $currSongId . '\', \'' . $currSong . '\',\'' . $currArtist . '\', \'' . $currCover . '\', \'' . $songUrl . '\')">
                                    <img src="'.$row['cover'].'" alt="">
                                    <div class="searchDetails">
                                        <span class="heading">'.$row['title'].'</span>
                                        <span class="subHeading">'.$artist_name.'</span>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="main-tab-content contentItem" id="tab2">
                <div class="searchContentHeader">
                    <input type="text" id="searchInput" placeholder="Search tracks, albums, artists and playlists...">
                </div>
                <div class="searchContentResult" id="searchResult">

                </div>
            </div>
            <?php
                $sql = "SELECT p.* FROM playlists p JOIN playlist_user pu ON p.id = pu.playlist_id WHERE pu.user_id ='$user_id'";
                $result = mysqli_query($conn, $sql);
                $count = 3;
                while($row=mysqli_fetch_assoc($result)){
                    $playlist_id = $row['id'];
                    echo '<div class="playlist-tab-content contentItem" id="tab'.$count.'">';
                        echo '<div class="playlistContentHeader">';
                            echo '<button onClick="deletePlaylist(\''.$playlist_id.'\')"><i class="fas fa-trash"></i></button>';
                            echo '<img src="'.$row['cover'].'" alt="">';
                            echo '<div class="playlistDetails">';
                                echo '<h1>'.$row['title'].'</h1>';
                            echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="playlistContentItems">';
                            $playlistQry = "SELECT t.*, ar.name AS artist_name, al.title AS album_title FROM tracks AS t JOIN artist_track AS art ON t.id = art.track_id JOIN artists AS ar ON art.artist_id = ar.id JOIN album_track AS alt ON t.id = alt.track_id JOIN albums AS al ON alt.album_id = al.id JOIN playlist_track AS pt ON t.id = pt.track_id WHERE pt.playlist_id ='$playlist_id'";
                            $playlistResult = mysqli_query($conn, $playlistQry);
                            while($playlistRow=mysqli_fetch_assoc($playlistResult)){
                                echo '<div class="songListItem">';
                                    echo '<i class="fas fa-play" onClick="loadMusic(\''.$playlistRow['id'].'\', \''.$playlistRow['title'].'\', \''.$playlistRow['artist_name'].'\', \''.$playlistRow['cover'].'\', \''.$playlistRow['url'].'\')"></i>';
                                    echo '<div class="songDetails">';
                                        echo '<img src="'.$playlistRow['cover'].'" alt="">';
                                        echo '<span class="songTitle">'.$playlistRow['title'].'</span> •';
                                        echo '<span class="albumTitle">'.$playlistRow['artist_name'].'</span> •';
                                        echo '<span class="albumTitle">'.$playlistRow['album_title'].'</span>';
                                    echo '</div>';

                                    require_once('./getid3./getid3/getid3.php');
                                    // Path to the song file
                                    $filePath = $playlistRow['url'];
                                    // Initialize getID3
                                    $getID3 = new getID3();
                                    // Analyze the file and get metadata
                                    $fileInfo = $getID3->analyze($filePath);
                                    // Get the duration of the song in seconds
                                    $duration = $fileInfo['playtime_seconds'];
                                    // Format the duration (optional)
                                    $formattedDuration = gmdate('i:s', $duration); // Example: 04:25
                                    
                                    echo '<div class="songMore">';
                                        echo '<span class="duration">'.$formattedDuration.'</span>';
                                    echo '</div>';
                                    echo '<div class="actionBtns">';
                                        echo '<a class="fas fa-trash-alt" onClick="deleteFromPlaylist(\''.$playlistRow['id'].'\', \''.$playlist_id.'\')"></a>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';

                    $count++;
                }
            ?>
        </div>
    </main>
    <div class="player">
        <audio id="audio-player"></audio>
        <div class="trackDetails">
            <img id="currCover" src="" alt="">
            <div class="title">
                <span id="currSong"></span>
                <span id="currArtist"></span>
            </div>
            <i class="far fa-heart" id="choosePlaylistBtn"></i>
        </div>
        <div class="playerControls">
            <div class="playerBtns">
                <i class="fas fa-step-backward" id="prevTrackBtn"></i>
                <i id="play-btn" class="fas fa-play"></i>
                <i id="pause-btn" class="fas fa-pause"></i>
                <i class="fas fa-step-forward" id="nextTrackBtn"></i>
            </div>
            <div class="trackSeeker">
                <span id="currTrackTime" class="currTrackTime"></span>
                <input id="seeker" value="0" type="range" name="seeker" id="" min="0" max="100">
                <span id="currTrackTotalTime" class="currTrackTotalTime"></span>
            </div>
        </div>
        <div class="playerVolume">
            <i class="fas fa-volume-up" id="volume-icon"></i>
            <input type="range" name="volume" id="volume-slider" min="0" max="1" step="0.01" value="1">
        </div>
    </div>

    <script src="js/home.js" defer></script>
    <script>
        // ============================== AUDIO PLAYER =================================
        const audioPlayer = document.getElementById("audio-player");
        const playButton = document.getElementById('play-btn');
        const pauseButton = document.getElementById('pause-btn');
        const progressBar = document.getElementById('seeker');
        const volumeIcon = document.getElementById('volume-icon')
        const volumeSlider = document.getElementById('volume-slider');

        const currCover = document.getElementById('currCover');
        const currSong = document.getElementById('currSong');
        const currArtist = document.getElementById('currArtist');

        const currTrackTime = document.getElementById("currTrackTime");
        const currTrackTotalTime = document.getElementById("currTrackTotalTime");

        let muted = false;

        // Play Audio Player
        const playAudioPlayer = () => {
            audioPlayer.play();
        }

        // Show hide play pause button
        const togglePlayPause = () => {
            if(audioPlayer.paused) {
                playButton.style.display = "inline-block"
                pauseButton.style.display = "none"
            }
            else{
                playButton.style.display = "none"
                pauseButton.style.display = "inline-block"
            }
        }
        togglePlayPause()

        // Play button click event
        playButton.addEventListener('click', function() {
            audioPlayer.play();
            togglePlayPause()
        });

        // Pause button click event
        pauseButton.addEventListener('click', function() {
            audioPlayer.pause();
            togglePlayPause()
        });

        // UPDATE PLAYER INFORMATION
        const updatePlayer = (artist, cover, title) => {
            currCover.src = cover;
            currSong.innerHTML = title;
            currArtist.innerHTML = artist;
        }
      
        // Load track to audio player
        const loadMusic = (id, title, artist, cover, url) => {
            setSongToPrevious(id);
            setSongIdToSession(id);
            console.log("Track loaded: " + url);
            audioPlayer.src = url;
            playAudioPlayer();
            updatePlayer(artist, cover, title);
        }

        const convertSecondsToMinutes = (seconds) => {
            const minutes = Math.floor(seconds / 60); // Get the whole number of minutes
            const remainingSeconds = seconds % 60; // Get the remaining seconds

            // Format the minutes and seconds with leading zeros if needed
            const formattedMinutes = String(minutes).padStart(2, '0');
            // Round the seconds 
            const roundedSeconds = Math.round(remainingSeconds);
            const formattedSeconds = String(roundedSeconds).padStart(2, '0');

            return `${formattedMinutes}:${formattedSeconds}`;
        }

        const updateTimers = () => {
            currTrackTime.innerHTML = convertSecondsToMinutes(audioPlayer.currentTime);
            currTrackTotalTime.innerHTML = convertSecondsToMinutes(audioPlayer.duration);
        }

        // Update progress bar as the audio plays
        audioPlayer.addEventListener('timeupdate', function() {
            updateTimers();
            const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressBar.value = progress;
            if(audioPlayer.currentTime == audioPlayer.duration){
                audioPlayer.paused = true
                loadNextSong();
            } 
            togglePlayPause();
        });

        // Seek progree bar as user clicks
        progressBar.addEventListener('input', () => {
            const seekTime = (progressBar.value / 100) * audioPlayer.duration
            audioPlayer.currentTime = seekTime
        })

        // Volume slider change event
        const changeVolume = () => {
            audioPlayer.volume = volumeSlider.value;
        }
        volumeSlider.addEventListener('input', () => changeVolume());

        // Mute / Unmute event
        const toggleVolume = () => {
            if(!muted){
                volumeIcon.classList.remove('fa-volume-up')
                volumeIcon.classList.add('fa-volume-mute')
                muted = true;
            }
            else{
                volumeIcon.classList.add('fa-volume-up')
                volumeIcon.classList.remove('fa-volume-mute')
                muted = false
            }
        }
        volumeIcon.addEventListener('click', () => {
            if(muted){
                toggleVolume()
                audioPlayer.volume = 1
                volumeSlider.value = 1
            }
            else{
                toggleVolume()
                audioPlayer.volume = 0
                volumeSlider.value = 0
            }
        })

        // SETTING CURRENT SONG TO SESSION
        const setSongIdToSession = (id) => {
            const url = 'http://localhost/musicly/api/setSongToSession.php';
            const songId = id;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            body: `songId=${encodeURIComponent(songId)}`,
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Song ID set in session successfully.');
                } else {
                    console.error('Error setting song ID in session.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        // =============================================================================

        // ================================= SEARCH ====================================
        
        // Get references to HTML elements
        var searchInput = document.getElementById('searchInput');
        var searchResults = document.getElementById('searchResult');
        
        var apiUrl = 'http://localhost/musicly/api/search.php';
        // Function to fetch search results
        function fetchSearchResults(query) {
            // Make a GET request using fetch()
            fetch(apiUrl + '?query=' + encodeURIComponent(query))
            .then(function(response) {
                if (response.ok) {
                    // Process the API response
                    return response.json();
                } else {
                    throw new Error('Error: ' + response.status);
                }
            })
            .then(function(data) {
                // Clear previous search results
                searchResults.innerHTML = '';

                // Display the search results
                data.forEach(function(result) {
                    searchResults.appendChild(createSearchItem(result.cover, result.title, result.name, result.url, result.id));
                });
            })
            .catch(function(error) {
                // Handle any errors that occurred during the request
                console.log('Request failed:', error);
            });
        }

        function createSearchItem (imgUrl, headingText, subheadingText, mp3Url, id){
            let searchResultItem = document.createElement("div");
            let searchResultCover = document.createElement("img");
            let searchDetails = document.createElement("searchDetails");
            let heading = document.createElement("heading");
            let subHeading = document.createElement("subHeading");

            searchResultCover.src = imgUrl;
            heading.innerHTML = headingText;
            subHeading.innerHTML = subheadingText;

            searchResultItem.setAttribute("class", "searchResultItem");
            searchDetails.setAttribute("class", "searchDetails");
            heading.setAttribute("class", "heading");
            subHeading.setAttribute("class", "subHeading");

            searchDetails.appendChild(heading);
            searchDetails.appendChild(subHeading);
            searchResultItem.appendChild(searchResultCover);
            searchResultItem.appendChild(searchDetails);

            // SEARCH ITEM ON CLICK EVENT
            searchResultItem.onclick = () => {
                loadMusic(id, headingText, subheadingText, imgUrl, mp3Url)
            }

            return searchResultItem;
        }

        // Event listener for search input changes
        searchInput.addEventListener('input', function() {
            var query = searchInput.value.trim();
            fetchSearchResults(query);
        });
        // =============================================================================

        // =============================== PLAYLIST ====================================
        // CREATE PLAYLIST CLICK EVENT
        const createPlaylistBtn = document.getElementById("createPlaylistBtn");
        createPlaylistBtn.onclick = () => {
            createPlaylist();
        }
        
        // SEND REQUEST TO CREATE A NEW PLAYLIST
        const createPlaylist = () => {
            const playlistTitleInput = document.getElementById("createPlaylistTitle");
            const playlistTitle = playlistTitleInput.value;
            
            const url = 'http://localhost/musicly/api/createPlaylist.php';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `title=${encodeURIComponent(playlistTitle)}`,
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Playlist created successfully.');
                    // Reload the page
                    location.reload();
                } else {
                    console.error('Creating playlist failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
            document.getElementById("createPlaylistModal").style.display = "none";
        }

        // SEND REQUEST TO DELETE A PLAYLIST
        const deletePlaylist = (playlistId) => {
            const url = 'http://localhost/musicly/api/deletePlaylist.php?id='+encodeURIComponent(playlistId);
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Playlist deleted successfully.');
                    // Reload the page
                    location.reload();
                } else {
                    console.error('Deleting playlist failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // SEND REQUEST TO ADD A TRACK TO A PLAYLIST
        // CREATE PLAYLIST CLICK EVENT
        const addToPlaylistBtn = document.getElementById("addToPlaylistBtn");
        addToPlaylistBtn.onclick = () => {
            addToPlaylist();
        }

        let selectedPlaylist = ""
        const updateSelectPlaylist = (e) => {
            console.log(e.target.value);
            selectedPlaylist = e.target.value;
        }
        const addToPlaylist = () => {
            console.log(selectedPlaylist)
            const playlist_id = selectedPlaylist;
            const url = 'http://localhost/musicly/api/addToPlaylist.php';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `playlist_id=${encodeURIComponent(playlist_id)}`,
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Track added to playlist successfully.');
                    // Reload the page
                    location.reload();
                } else {
                    console.error('Adding track to playlist failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
            document.getElementById("choosePlaylistModal").style.display = "none";
        }

        // SEND REQUEST TO DELETE A TRACK FROM A PLAYLIST
        const deleteFromPlaylist = (track_id, playlist_id) => {
            const tid = track_id;
            const pid = playlist_id;
            const url = 'http://localhost/musicly/api/deleteFromPlaylist.php?track_id='+encodeURIComponent(tid)+'&playlist_id='+encodeURIComponent(pid);
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Track deleted from playlist successfully.');
                    // Reload the page
                    location.reload();
                } else {
                    console.error('Deleting track from playlist failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        // =============================================================================

        // =============================================================================================
        const prevTrackBtn = document.getElementById("prevTrackBtn");
        const nextTrackBtn = document.getElementById("nextTrackBtn");
        
        const setSongToPrevious = (id) => {
            const track_id = id;
            const url = 'http://localhost/musicly/api/setSongToPrevious.php?track_id='+encodeURIComponent(track_id);
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data.status === 'success') {
                    console.log('Track added to history successfully.');
                } else {
                    console.error('Adding track to history failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        nextTrackBtn.onclick = () => {
            loadNextSong();
        }
        const loadNextSong = () => {
            const year = "2010";
            const url = 'http://localhost/musicly/api/loadNextTrack.php?year='+encodeURIComponent(year);
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data) {
                    let rnd = Math.floor(Math.random() * (data.length));
                    id = data[rnd].id;
                    artist = data[rnd].name; 
                    cover = data[rnd].cover;
                    title = data[rnd].title;
                    trackUrl = data[rnd].url;
                    
                    loadMusic(id, title, artist, cover, trackUrl);
                } else {
                console.error('Error getting data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        prevTrackBtn.onclick = () => {
            loadPreviousSong();
        }
        const loadPreviousSong = () => {
            const url = 'http://localhost/musicly/api/loadPreviousTrack.php';
            fetch(url)
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data) {
                    id = data[0].id;
                    artist = data[0].name;
                    cover = data[0].cover;
                    title = data[0].title;
                    trackUrl = data[0].url;
                    console.log("Track loaded: " + trackUrl);
                    setSongIdToSession(id);
                    audioPlayer.src = trackUrl;
                    audioPlayer.play();
                    updatePlayer(artist, cover, title);
                } else {
                console.error('Error getting data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        // =============================================================================================

        // LOAD PLAYER ON DOCUMENT LOAD
        const setPlayerOnLoad = (id) => {
            let artist = "";
            let cover = "";
            let title = "";
            let url = 'http://localhost/musicly/api/setPlayerOnLoad.php?id='+id;

            fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the PHP script
                if (data) {
                    artist = data[0].name;
                    cover = data[0].cover;
                    title = data[0].title;
                    trackUrl = data[0].url;
                    console.log("Track loaded: " + trackUrl);
                    audioPlayer.src = trackUrl;
                    updatePlayer(artist, cover, title);
                } else {
                console.error('Error getting data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
        }

        setPlayerOnLoad(<?php echo isset($_SESSION['song_id']) ? $_SESSION['song_id'] : 4; ?>);
    </script>
</body>
</html>