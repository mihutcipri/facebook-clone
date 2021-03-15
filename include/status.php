<div class="profile-status-write">
    <div class="status-wrap">
        <div class="status-top-wrap">
            <div class="status-top">
                Create Post
            </div>
        </div>

        <div class="status-med">
            <div class="status-prof">
                <div class="top-pic"><img src="<?php echo $userData->profilePic;  ?>" alt=""></div>
            </div>
            <div class="status-prof-textarea" style="position:relative;">
                <textarea name="textStatus" id="statusEmoji" cols="5" rows="5" class="status align-middle" placeholder="What's going on your mind?"></textarea>
                <ul class="hash-men-holder" style="position:absolute;margin-top: 0;"></ul>
            </div>
        </div>
        <div class="status-bot">
            <div class="file-upload-remIm input-restore">

                <label for="multiple_files" class="file-upload-label">
                    <div class="status-bot-1">
                        <img src="assets/image/photo.JPG" alt="">
                        <div class="status-bot-text">Photo/Video</div>
                    </div>
                </label>
                <input type="file" name="post-file-upload" id="multiple_files" class="file-upload-input postImage" data-multiple-caption="{count} files selected" multiple="">

            </div>
            <div class="status-bot-1">
                <img src="assets/image/tag.JPG" alt="">
                <div class="status-bot-text">Tag Friends</div>
            </div>
            <div class="status-bot-1">
                <img src="assets/image/activities.JPG" alt="">
                <div class="status-bot-text">Feeling/Activities</div>

            </div>
            <div class="status-bot-1 dott">...</div>
        </div>
        <ul id="sortable" style="position:relative;">

        </ul>
        <div id="error_multiple_files"></div>
        <div class="status-share-button-wrap">
            <div class="status-share-button">
                <div class="newsFeed-privacy">
                    <div class="newsFeed">
                        <div class="right-sign-icon">
                            <img src="assets/image/profile/rightSign.JPG" alt="">
                        </div>
                        <div class="newsfeed-icon align-middle">
                            <img src="assets/image/profile/newsFeed.JPG" alt="">
                        </div>
                        <div class="newsfee-text">
                            News Feed
                        </div>
                    </div>
                    <div class="status-privacy-wrap">
                        <div class="status-privacy">
                            <div class="privacy-icon align-middle">
                                <img src="assets/image/profile/publicIcon.JPG" alt="">
                            </div>
                            <div class="privacy-text">Public</div>
                            <div class="privacy-downarrow-icon align-middle">
                                <img src="assets/image/watchmore.png" alt="">
                            </div>
                        </div>
                        <div class="status-privacy-option">

                        </div>
                    </div>
                </div>

            </div>
            <div class="seemore-sharebutton">
                <div class="share-seemore-option">
                    <div class="privacy-downarrow-icon align-middle">
                        <img src="assets/image/watchmore.png" alt="">
                        <span class="status-seemore">See More</span>
                    </div>
                </div>
                <div class="status-share-button align-middle">
                    Share
                </div>
            </div>
        </div>
    </div>
</div>
