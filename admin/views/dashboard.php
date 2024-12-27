<div class="row">
    <div class="col-lg-12">
        <div class="widget-container stats-container">
            <div class="col-lg-12">
                <a href="./index.php?pid=user">
                    <?php $qry="SELECT id FROM tbl_users WHERE status!=2";
                        $totalEvent=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-male "></div>
                        &nbsp;
                        <?php echo $totalEvent; ?>
                    </div>
                    <div class="text">Users</div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="widget-container stats-container">
            <div class="col-lg-2">
                <a href="./index.php?pid=assessment">
                    <?php  $qry="SELECT assessmentsid FROM   tbl_assessments_tests inner join tbl_assessments_category on tbl_assessments_category.categoryid=tbl_assessments_tests.fk_category_id  WHERE tbl_assessments_category.status=1 and statuscheck!=2";
                        $totalEvent=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt "></div>
                        &nbsp;
                        <?php echo $totalEvent; ?>
                    </div>
                    <div class="text">Assessments</div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="./index.php?pid=fragnets">
                    <?php $qry="SELECT fragnetid FROM tbl_fragnets WHERE statuscheck!=2";
                        $totalEvent=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt"></div>
                        &nbsp;
                        <?php echo $totalEvent; ?>
                    </div>
                    <div class="text">Fragnets</div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="./index.php?pid=evm">
                    <?php $qry="SELECT evmid FROM tbl_evm WHERE statuscheck!=2";
                        $totalEvent=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt"></div>
                        &nbsp;
                        <?php echo $totalEvent; ?>
                    </div>
                    <div class="text">EVM</div>
                </a>
            </div>
            <div class="col-lg-2">
                 <a href="./index.php?pid=breakdown">
                    <?php $qry="SELECT breakdownid FROM tbl_breakdown WHERE statuscheck !=2";
                        $totalManager=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt"></div>
                        &nbsp;
                        <?php echo $totalManager; ?>
                    </div>
                    <div class="text">Work Breakdowns</div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="./index.php?pid=analytics">
                    <?php $qry="SELECT analyticsid FROM tbl_analytics WHERE statuscheck != 2";
                        $totalmanagerUser=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt"></div>
                        &nbsp;
                        <?php echo $totalmanagerUser; ?>
                    </div>
                    <div class="text">Schedule Analytics</div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="./index.php?pid=forensic">
                    <?php $qry="SELECT forensicid FROM tbl_forensic WHERE statuscheck !=2";
                        $totalmanagerUser=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="icon-list-alt"></div>
                        &nbsp;
                        <?php echo $totalmanagerUser; ?>
                    </div>
                    <div class="text">Forensics Analytics</div>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="widget-container stats-container">
            <div class="col-lg-3">
                <a href="./index.php?pid=assessment">
                    <?php $qry="SELECT categoryid FROM `tbl_assessments_category` left join  tbl_assessments_tests on tbl_assessments_tests.fk_category_id = tbl_assessments_category.categoryid where tbl_assessments_category.categoryid = '1' and status != 2 and statuscheck !='2'";
                        $totalmanagerUser=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="glyphicon glyphicon-question-sign"></div>
                        &nbsp;
                        <?php echo $totalmanagerUser; ?>
                    </div>
                    <div class="text">EPC Test</div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="./index.php?pid=assessment">
                    <?php $qry="SELECT categoryid FROM `tbl_assessments_category` left join  tbl_assessments_tests on tbl_assessments_tests.fk_category_id = tbl_assessments_category.categoryid where tbl_assessments_category.categoryid = '2' and status != 2 and statuscheck !='2'";
                        $totalmanagerUser=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="glyphicon glyphicon-question-sign"></div>
                        &nbsp;
                        <?php echo $totalmanagerUser; ?>
                    </div>
                    <div class="text">EVM Test</div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="./index.php?pid=assessment">
                    <?php $qry="SELECT categoryid FROM `tbl_assessments_category` left join  tbl_assessments_tests on tbl_assessments_tests.fk_category_id = tbl_assessments_category.categoryid where tbl_assessments_category.categoryid = '3' and status != 2 and statuscheck !='2'";
                        $totalmanagerUser=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="glyphicon glyphicon-question-sign"></div>
                        &nbsp;
                        <?php echo $totalmanagerUser; ?>
                    </div>
                    <div class="text">Planning Test</div>
                </a>
            </div>
            <div class="col-lg-3">
                 <a href="./index.php?pid=assessment">
                    <?php $qry="SELECT categoryid FROM `tbl_assessments_category` left join  tbl_assessments_tests on tbl_assessments_tests.fk_category_id = tbl_assessments_category.categoryid where tbl_assessments_category.categoryid = '4' and status != 2 and statuscheck !='2'";
                        $totalManager=$model_class->numRows($qry); ?>
                    <div class="number">
                        <div class="glyphicon glyphicon-question-sign"></div>
                        &nbsp;
                        <?php echo $totalManager; ?>
                    </div>
                    <div class="text">Procurement Test</div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Statistics
