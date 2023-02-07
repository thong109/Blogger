/**
 * ****************************************************************************
 * tab-video.js
 *
 * Description		:	Methods and events for watch video
 * Created at		:	29/11/2022
 * Created by		:	Thong109 – thong.phan109@gmail.com
 * package		    :	Client
 * ****************************************************************************
 */
 $(document).ready(function () {
    var $videoSrc;
    var $videoId;
    VideoModule.InitEvents();
    VideoModule.OnModal();
    VideoModule.OffModal();
 });
 
 /**
 * @author  Thong109 - thong.phan109@gmail.com
 * @param
 * @return { Function } VideoModule.InitEvents() - Initialize events
 * @return { Function } VideoModule.OnModal() - Initiating events on modal
 * @return { Function } VideoModule.OffModal() - Initiating events off modal
 */
 var VideoModule = (function () {
    
     /**
     * Initiating events in the page
     *
     * @author Thong109 - 29/11/2022 - create
     * @param
     * @return
     */
    var InitEvents = function () {
       try {
          $('.video-btn').click(function () {
             $videoSrc = $(this).data("src");
             $videoId = $(this).data("id");
          });
       } catch (e) {
          console.log('InitEvent: ' + e.message);
       }
    };
    
    /**
     * When the modal is opened autoplay it
     *
     * @author Thong109 - 29/11/2022 - create
     * @param
     * @return
     */
    var OnModal = function () {
       try {
          $('#myModal').on('shown.bs.modal', function (e) {
             // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
             $(".tabvideo").attr('src', 'https://player.vimeo.com/video/' + $videoSrc + "?autoplay=1&modestbranding=1&showinfo=0");
             $('.tabvideo').attr('class', 'tabvideo dark');
             $('.tabvideo').attr('id', $videoId);
          });
       } catch (e) {
          console.log('OnModal: ' + e.message);
       }
    };

    /**
     * Stop playing the youtube video when I close the modal
     *
     * @author Thong109 - 29/11/2022 - create
     * @param
     * @return
     */
    var OffModal = function () {
       try {
          $('#myModal').on('hide.bs.modal', function (e) {
             // a poor man's stop video
             $(".tabvideo").attr('src', '');
             $(".tabvideo").attr('class', 'tabvideo');
             $('.tabvideo').attr('id', $videoId);
          });
       } catch (e) {
          console.log('OffModal: ' + e.message);
       }
    };
 
    return {
       InitEvents: InitEvents,
       OnModal: OnModal,
       OffModal: OffModal
    };
 })();