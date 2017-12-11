<div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Comments</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        
                        <table class="table table-striped table-bordered">
                            <?php
                            $this->load->module('timedate');
                            foreach($query->result() as $row) { ?>
                            <tr>
                                <td><?php
                                    $date_created = $this->timedate->get_nice_date($row->date_created, 'full');
                                    echo "<i>Date Submitted: ".$date_created."</i><br><br>";
                                    echo nl2br($row->comment);
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>

                    </div>

                </div>
</div>