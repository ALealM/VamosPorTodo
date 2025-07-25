<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page  {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2.5cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.5cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
                bottom: 0cm;
            }
            .page-number:before {
                position: fixed;
                left: 9.5cm;
                bottom: 1.2cm;
                color: #aaa;
                font-size: 0.9em;
                z-index: 9999;
                content: "Página " counter(page);
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="<?php echo e(asset('img/encabezadoInf.png')); ?>" width="100%" height="100%"/>
        </header>

        <footer>
            <div class="page-number"></div>
            <img src="<?php echo e(asset('img/footerInf.png')); ?>" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div style="padding-top: 0px; font-family: 'Times New Roman', Times, serif; font-size: 11px">
                <div style="text-align: center; font-size: 14px"><b><?php echo e($colonia->colonia); ?></b><hr></div>
                <?php $__currentLoopData = $rubros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rubro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="text-align: center; font-size: 13px"><br><b><?php echo e($rubro->nombre); ?></b></div>
                <?php if($rubro->solicitudes->isEmpty()): ?>
                <div style="text-align: center">Sin Asuntos Registrados<br><br></div>
                <?php else: ?>
                <?php $__currentLoopData = $rubro->solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <table class="table-hover table-bordered" style="width: 100%; padding-top: 0px; margin-top: 0px">
                    <tbody>
                        <tr>
                            <th style="border: 2px solid <?php echo e($solicitud->semaforo==0 ? '#940a0a;' : (($solicitud->semaforo==1) ? '#b88400;' : (($solicitud->semaforo==2) ? '#048506;' : '#048506;'))); ?>

                                ;text-align: center; color:<?php echo e($solicitud->semaforo==0 ? '#940a0a;' : (($solicitud->semaforo==1) ? '#b88400;' : (($solicitud->semaforo==2) ? '#b85000;' : '#048506;'))); ?>; 
                                text-transform: uppercase; font-size: 14px; width: 120px">
                                <?php echo $solicitud->estatus(); ?>

                            </th>
                            <td><h4><b>ASUNTO:</b> <?php echo $solicitud->asunto; ?></h4></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">FECHA</th>
                            <td style=" text-transform: uppercase"><?php echo e($dias[date('w', strtotime($solicitud->fecha_alta))]); ?> <?php echo e(date('j', strtotime($solicitud->fecha_alta))); ?> de <?php echo e($meses[date('n', strtotime($solicitud->fecha_alta))-1]); ?> de <?php echo e(date('Y', strtotime($solicitud->fecha_alta))); ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">DESCRIPCIÓN</th>
                            <td><?php echo $solicitud->descripcion; ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">UBICACIÓN</th>
                            <td><?php echo $solicitud->ubicacion; ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">PROGRAMA</th>
                            <td><?php echo $solicitud->programa()->nombre; ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: center; background-color:#ddd">RESPONSABLE</th>
                            <td><?php echo $solicitud->responsable()->direccion; ?></td>
                        </tr>
                    </tbody>
                </table><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br>
                <table class="table-hover table-bordered" style="width: 60%; padding-top: 0px; margin-top: 0px; font-size: 10px">
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #000;"></td>
                            <td style="border-bottom: 1px solid #000;">*** NOMENCLATURA ***</td>
                        </tr>                        
                        <tr>
                            <td style="border-bottom: 2px solid #940a0a; text-align: center; color: #940a0a; text-transform: uppercase; width: 80px">
                                REPORTADO
                            </td>
                            <td>La solicitud ha sido creada y se encuentra pendiente de iniciar.</td>
                        </tr>                        
                        <tr>
                            <td style="border-bottom: 2px solid #b88400; text-align: center; color: #b88400; text-transform: uppercase;">
                                INICIADO
                            </td>
                            <td>El proceso de la solicitud ha iniciado pero no tiene avance alguno.</td>
                        </tr>                        
                        <tr>
                            <td style="border-bottom: 2px solid #b85000; text-align: center; color: #b85000; text-transform: uppercase;">
                                EN PROCESO
                            </td>
                            <td>El proceso se encuentra en curso con un porcentaje de avance.</td>
                        </tr>                        
                        <tr>
                            <td style="border-bottom: 2px solid #048506; text-align: center; color: #048506; text-transform: uppercase;">
                                CONCLUIDO
                            </td>
                            <td>El proceso de la solicitud ha concluido satisfactoriamente.</td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>