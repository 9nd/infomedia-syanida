<?php echo card_open('Form', 'bg-green', true) ?>

<div class="row">
    <div class="col-md-3 col-xl-3">
        <h3 class="mb-4">MESSAGE </h3>

        <div>
            <div class="list-group list-group-transparent mb-0">
                <a href="<?php echo $link_inbox; ?>" class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="icon mr-3"></span>Inbox <span class="ml-auto badge bg-blue" ><div  id="get_inbox">0</div></span>
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
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">INBOX</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list = $data->result();
                        if (count($list) > 0) {
                            // $no = 1;
                            $style = "";
                            $no = $this->uri->segment('4') + 1;
                            foreach ($list as $r_data) {
                                if ($r_data->status_read == 0 && $id_login == $r_data->to_user_id) {
                                    $style = ' style="font-weight:bold"';
                                }
                                ?> <tr <?php echo $style; ?>>

                                    <td><?php echo $no;  ?></td>


                                    <?php
                                            $query = $controller->db->query("
                                                        SELECT
                                                            sys_message.*,
                                                            sys_user.nama,
                                                            sys_user.opt_level 
                                                        FROM
                                                            sys_message
                                                            INNER JOIN sys_user ON sys_message.from_user_id = sys_user.id 
                                                        WHERE
                                                            group_id = $r_data->group_id 
                                                        ORDER BY
                                                            id DESC 
                                                            LIMIT 1
                                                        ");
                                            $row = $query->row();
                                            if (isset($row)) {
                                                echo "<td>";
                                                echo substr($row->nama, 0, 8);
                                                echo "(";
                                                if ($row->opt_level == 8) {
                                                    echo "AGNT";
                                                } elseif ($row->opt_level == 9) {
                                                    echo "TL";
                                                } elseif ($row->opt_level == 6) {
                                                    echo "IT";
                                                } else {
                                                    echo "SU";
                                                };
                                                echo ")";
                                                echo "</td>";
                                                echo " <td><a href=";
                                                echo base_url() . "Inbox/Inbox/read?group_id=" . $r_data->group_id . ">";
                                                echo substr($r_data->subject, 0, 15);
                                                echo "</a></td>";
                                                echo "<td>";
                                                echo substr($row->conten, 0, 25);
                                            }

                                            ?></td>
                                    <td><?php echo $r_data->datetime; ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo base_url() . "Inbox/Inbox/read?group_id=" . $r_data->group_id ?>" class="btn btn-secondary btn-sm">Read</a>
                                    </td>
                                </tr>


                        <?php
                                $no++;
                            }
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
                <?php echo $pagination; ?>
                <script>
                    require(['datatables', 'jquery'], function(datatable, $) {
                        $('.datatable').DataTable();
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php echo card_close() ?>

<script>
    var page_version = "1.0.8"
</script>
