<?php $__env->startSection('content-widget'); ?>






<?php echo $__env->make('pages.manager.nav_panel_widgets.header-cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card card-custom gutter-b">
    <div class="card-body p-0">
        <!-- begin: Invoice-->
        <!-- begin: Invoice header-->
        <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                    <h1 class="display-4 font-weight-boldest mb-10">ИНФОРМАЦИЯ КАРТЫ</h1>
                    <div class="d-flex flex-column align-items-md-end px-0">
                        <!--begin::Logo-->
                        <a href="#" class="mb-5">
                            <h4 class="text-dark"><?php echo e($card->number); ?></h4>
                        </a>
                        <!--end::Logo-->
                        <span class="d-flex flex-column align-items-md-end opacity-70">
                            <span><?php echo e($card->card_description); ?></span>
                            <span><?php echo e($card->card_type); ?></span>
                        </span>
                    </div>
                </div>
                <div class="border-bottom w-100"></div>
                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Срок действия</span>
                        <span class="opacity-70"><?php echo e($card->expiredAt->format('M d, Y')); ?></span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Пользователь</span>
                        <span class="opacity-70"><?php echo e($card->user->fullname ?? 'none'); ?></span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">Геолокация</span>
                        <span class="opacity-70"><?php echo e($code->geo ?? 'Россия'); ?>

																<br>Fredrick Nebraska 20620</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: Invoice header-->
        <!-- begin: Invoice body-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>

                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Cумма</th>
                            <th class="text-right font-weight-bold text-muted text-uppercase">Валюта</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $card->payments()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="font-weight-boldest">
                            <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                <!--begin::Symbol-->
                                <!--end::Symbol-->
                                <?php echo e($payment->type); ?>

                            </td>

                            <td class="text-primary pr-0 pt-7 text-right align-middle"><?php echo e($payment->amount); ?></td>
                            <td class="text-right pt-7 align-middle"><?php echo e($payment->currency); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: Invoice body-->
        <!-- begin: Invoice footer-->
        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="font-weight-bold text-muted text-uppercase">СПОСОБ ОПЛАТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase">СТАТУС КАРТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase">ДАТА ОПЛАТЫ</th>
                            <th class="font-weight-bold text-muted text-uppercase text-right">ИТОГО</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="font-weight-bolder">
                            <td><?php echo e($card->card_description); ?></td>
                            <td><?php echo e($card->state); ?></td>
                            <td><?php echo e($card->expiredAt->format('M d, Y')); ?></td>
                            <td class="text-primary font-size-h3 font-weight-boldest text-right"><?php echo e($card->amount()); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: Invoice footer-->
        <!-- begin: Invoice action-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                    <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                </div>
            </div>
        </div>
        <!-- end: Invoice action-->
        <!-- end: Invoice-->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.manager.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/widgets/card.blade.php ENDPATH**/ ?>