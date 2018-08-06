<div class="card" style="background-color: #46B24C">
    <div class="card-content notas">
      <h4 class="white-text">Notas</h4>

    </div>
    <div class="card-tabs" >
      <ul class="tabs tabs-transparent" tabs reload="allTabContentLoaded"><!-- tabs-fixed-width -->
        <li class="tab"><a class="active" href="#tab_activos">bimestre 1</a></li>
        <li class="tab"><a href="#tab">bimestre 2</a></li>
        <li class="tab"><a href="#tab">bimestre 3</a></li>
        <li class="tab"><a href="#tab">bimestre 4</a></li>
        <li class="tab notas"><a href="#tab"ng-click="nueva_materia()"><i class="material-icons" style="line-height: inherit">add</i></a></li>
        </a>
      </ul>
    </div>
    <div class="card-content blue lighten-5">
      <div id="tab_activos">
          <table class="responsive-table ">
            <thead>
              <th>N°</th>
              <th>Nombres</th>
              <th>n1</th>
              <th>n2</th>
              <th>n3</th>
            </thead>
            <tbody>
            <tr ng-repeat="a in bloqueq">
              <td></td>
                <td>{{a[0].nombres}}</td>

                <?php 
                $conta= 2;

                for ($i = 1; $i <= $conta; $i++) { ?>
                  <td>{{a[0].<?php echo 'mo_'.$i ?>}}</td>
                <?php } ?>
            </tr>
            </tbody>
          </table>
      </div>
    </div>
</div>






<!--                 <td>{{a[0].mo_1}}</td>
                <td>{{a[0].mo_2}}</td>
                <td>{{a[0].mo_3}}</td> -->



