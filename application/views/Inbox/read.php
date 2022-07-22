<?php echo card_open('Form', 'bg-green', true) ?>

<div class="row">
    <div class="col-md-3 col-xl-3">
        <h3 class="mb-4">MESSAGE </h3>

        <div>
            <div class="list-group list-group-transparent mb-0">
                <a href="<?php echo $link_inbox; ?>" class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="icon mr-3"></span>Inbox <span class="ml-auto badge bg-blue"><div  id="get_inbox">0</div></span>
                </a>
                <!-- <a href="<?php echo $link_compose; ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Sent Mail
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Important <span class="ml-auto badge bg-gray">3</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Starred
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Drafts
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Tags
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Trash
                </a> -->
            </div>

            <div class="mt-4">
                <a href="<?php echo $link_compose; ?>" class="btn btn-secondary btn-block">Compose new Message</a>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <form id='form-a' method="POST">
                    <div class="input-group">
                        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                        <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                        <input type="text" name="conten" style="width:600px;" class="form-control" placeholder="Reply">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">
                                Reply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="list-group card-list-group">
                <?php
                $data = $data->result();
                if (count($data) > 0) {
                    foreach ($data as $r_d) {
                ?>
                        <li class="list-group-item py-5">
                            <div class="media">
                                <div class="media-object avatar avatar-md mr-4" style="background-image: url(<?php echo base_url() . "YbsService/get_foto_agent/" . $r_d->picture; ?>)"></div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <small class="float-right text-muted"><?php echo $r_d->datetime ?></small>
                                        <h5><?php echo $r_d->nama ?></h5>
                                    </div>
                                    <div>
                                        <?php echo $r_d->conten ?>
                                    </div>
                                </div>
                            </div>
                        </li>

                <?php
                    }
                }
                ?>

            </ul>
            <?php echo $pagination;?>
        </div>

    </div>
</div>
<?php echo card_close() ?>

<script>
    var page_version = "1.0.8"
</script>
<script type="text/javascript">
    function get_inbox() {
        $.ajax({
            url: "<?php echo base_url() . "Inbox/Inbox/get_inbox" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $("#get_inbox").text(response.get_inbox);

            }
        });
    } 


    setInterval(function () { }, 300000);
    setInterval(function () {
        get_inbox();
    }, 5000);


    

    $(document).ready(function() {
        get_inbox();

    });
</script>