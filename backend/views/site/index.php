<?php

/** @var yii\web\View $this */
/** @var int $totalUsers */
/** @var int $totalIssuances */
/** @var int $totalSurrenders */
/** @var int $totalMaintenances */
/** @var int $department */

$this->title = 'ICT Asset App Admin';
// echo '<pre>';
// var_dump($totalUsers);
// echo '</pre>';
?>
<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent"> -->
        <!-- <h1 class="display-4">ICT Asset Home</h1>

        <p class="lead">An equipment control hub.</p> -->

        <div class="body-content">
        <div class="row">
            <!-- Issuance Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Issuances</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalIssuances ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo \yii\helpers\Url::to(['/issuances/index']) ?>">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surrender Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Surrenders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalSurrenders ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo \yii\helpers\Url::to(['/surrenders/index']) ?>">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Maintenance Card -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Maintenance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Coming Soon</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cogs fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Disposal Card -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsers ?></div>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo \yii\helpers\Url::to(['/user/index']) ?>">
                                <i class="fas fa-arrow-circle-right fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <!-- </div> -->

    </div>

    
</div>