<ul>
	<li>Horas normales: <?php echo ($ht <= 40) ? $ht : 40; ?></li>
	<li>Sueldo por hora normal: <?php echo ($ht <= 40) ? $total : $sueldo_hn; ?> </li>
	<li>TOTAL: <?php echo $total ?></li>
</ul>