
    <!--   ////////.........start header tob bar................//////-->
<?php include 'include/header.php'; ?>
    <!--   ////////.........end header tob bar................//////-->


    <!--   ////////.........start main area................//////-->
    <main>
        <div class="main_area" style="margin-top: 0; padding-top: 12px;">
            <!--   ////////.........start first section................//////-->

            <div class="first-section">
                <div class="active-wrap top-pic-name-wrap   ">
                    <a href="profile.php" class="top-pic-name">
                        <div class="top-pic"><img src="assets/image/me.jpg" alt=""></div>
                        <div class="top-name top-css" style="color:black;">Habib</div>
                    </a>
                </div>
                <br>

                <div class="news-feed">
                    <a href="index.php" class="active-wrap-2">
                        <div class="right-nav-icon">
                            <img src="assets/image/newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">News Feed</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="messenger.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/image/msginnews.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Messenger</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="watch.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/image/watchnewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Watch</div>
                    </a>
                </div>
                <p class="first-sect-head">Shortcuts</p>

                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/pagenewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Upwork Bangladesh</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/groupnewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Upwork Bangladesh</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/profoundlynewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">profoundly</div>
                    </a>
                </div>
                <p class="first-sect-head">Explore</p>

                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/page_color_newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Pages</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/group_color_newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Groups</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/event.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Events</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/saved.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Saved</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/image/fundraises.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Fundraisers</div>
                    </a>
                </div>




            </div>
            <!--   ////////.........end first section................//////-->

            <!--   ////////.........start second section................//////-->

            <div class="second-section">
                <!--                ............ Start Status write part................-->
<?php include 'include/status.php'; ?>
                <!--                ............ end Status write part................-->

                <!--                ............ Start timeline part................-->

                <div class="news-feed-comp">
               <?php $loadFromPost->homePosts($userid, $profileId, 20) ?>

                </div>
                <div class="loader-wrap align-middle " style="width: 100%;">

                </div>
                <!--                ............ end timeline................-->
            </div>
            <div class="third-section">
                <div class="story-wrap">
                    <div class="story-head">
                        Stories
                    </div>
                    <div class="add-story">
                        <div class="add-circle">
                            +
                        </div>
                        <div class="add-your-story-wrap">
                            <div class="add-your-story">
                                Add to Your Story
                            </div>
                            <div class="add-story-details">
                                Share a photo, video or write something
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/image/me.jpg" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Raihan Kabir</div>
                                <div class="story-profile-time">2 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/image/me2.jpg" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Mahir Shishir</div>
                                <div class="story-profile-time">3 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/image/me3.png" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Raihan Jebin</div>
                                <div class="story-profile-time">1 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <div class="more-story"><img src="assets/image/seeMoreStory.JPG" alt="">
                        <div>See More</div>
                    </div>
                </div>
                <div class="birthday-wrap">
                    <a href="" class="birthday-gift">
                        <div class="birth-img">
                            <img src="assets/image/birthdayGift.JPG" alt="">
                        </div>
                        <div class="birth-name-wrap"><span class="birth-name">Mahir Shishir</span><span class="birth-date">'s birthday today</span></div>
                    </a>
                </div>
                <div class="friend-request-wrap">
                    <div class="friend-request-text-wrap">
                        <div class="friend-request-text">Friend Request</div>
                        <div class="friend-request-seeAll">See All</div>
                    </div>

                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/image/me3.png" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Maruf Hossain</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/image/me2.jpg" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Kamrul Hassan</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/image/me.jpg" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Shareef Kabir</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="fourth-section">
                <div class="active-user-wrap">
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/image/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Jarib Farhan
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/image/me2.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Rashid Shareef
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/image/me3.png" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Kamal Joardar
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/image/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Tahin Ashab
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/image/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Sheikh kalim
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-box-show"></div>
            <div id="adv_dem"></div>

    </main>

 <script src="assets/js/jquery.js "></script>
        <script src="assets/dist/emojionearea.min.js"></script>
        <script src="assets/js/main.js"></script>
</body>

</html>
