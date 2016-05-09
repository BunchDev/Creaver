@extends('alumno.index')

@section('content')

{{Html::script('scripts/alumno/abp.js')}}

{{Html::style('css/abp.css')}}


 <div class="btn-primary" id="flag_ins">
   
    <i class="fa fa-pencil" style="color:white;font-size:40;" id="pen_flag"></i> <label class="btn-success"> Añadir Fuente</label>
</div>

<div id="forms_conceptos" align="center">
  <div class="row concept-box" id="sec_1">

    <div class="col-md-7">
      <div class="form-inline pform">
        <label for="palabra">Palabra</label>
        <input type="text" class="palabra form-control">
        <textarea rows="4" style="width: 50%;" class="definicion form-control" placeholder="Escribe la definición aquí"></textarea>
      </div>
    </div>

    <div class="col-md-4">

      <div class="row">

        <div class="col-md-9">
          <label for="fuente">Fuente</label>
          <div class="fuente form-control"></div>
        </div>
        <div class="col-md-3">
          <div class="round-button rbfuente"><div class="round-button-circle btn-primary"><a data-toggle="modal" data-target="#modal_1" class="round-button"><i class="fa fa-pencil"></i></a></div></div>
        </div>
      </div>
    </div>

<!--MODAL -->
  <div id="modal_1" class="modal fade" role="dialog">
    <input type="hidden" class="type_apa" value="">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FORMATO APA</h4>
          <select class="selectpicker" data-style="btn-primary" onchange="getModalBody(1,'')" title="¿Que quieres citar?">
            <option data-content='<i class="fa fa-book" aria-hidden="true"></i> Libro Electrónico'>libro</option>
            <option data-content='<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                Revista Científica Electrónica'>revista</option>
            <option data-content='<i class="fa fa-globe" aria-hidden="true"></i> Página Web' >web</option>
          
          </select>
        </div>
     
        <div class="modal-body">
          <!--BODY DEL MODAL-->
        
          <!--FIN BODY-->


        </div>
        <div class="modal-footer">
      	 <button type="button" class="btn btn-success" onClick="makeFormat('1')">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
  
      </div>

    </div>
  </div>

  </div>

  <!--FORM 2-->
  <div class="row concept-box" id="sec_2">

    <div class="col-md-7">
      <div class="form-inline pform">
        <label for="palabra">Palabra</label>
        <input type="text" class="palabra form-control">
        <textarea rows="4" style="width: 50%;" class="definicion form-control" placeholder="Escribe la definición aquí"></textarea>
      </div>
    </div>

    <div class="col-md-4">

      <div class="row">

        <div class="col-md-9">
          <label for="fuente">Fuente</label>
          <div class="fuente form-control"></div>
        </div>
        <div class="col-md-3">
          <div class="round-button rbfuente"><div class="round-button-circle btn-primary"><a data-toggle="modal" data-target="#modal_2" class="round-button"><i class="fa fa-pencil"></i></a></div></div>
        </div>
      </div>
    </div>

<!--MODAL -->
  <div id="modal_2" class="modal fade" role="dialog">
    <input type="hidden" class="type_apa" value="">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FORMATO APA</h4>
          <select class="selectpicker" data-style="btn-primary" onchange="getModalBody(2,'')" title="¿Que quieres citar?">
            <option data-content='<i class="fa fa-book" aria-hidden="true"></i> Libro Electrónico'>libro</option>
            <option data-content='<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                Revista Científica Electrónica'>revista</option>
            <option data-content='<i class="fa fa-globe" aria-hidden="true"></i> Página Web' >web</option>
          
          </select>
        </div>
     
        <div class="modal-body">
          <!--BODY DEL MODAL-->
        
          <!--FIN BODY-->


        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" onClick="makeFormat('2')">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
  
      </div>

    </div>
  </div>

  </div>
  
  <!--FIN FORM 2-->

  <!--FORM 3-->
  <div class="row concept-box" id="sec_3">

    <div class="col-md-7">
      <div class="form-inline pform">
        <label for="palabra">Palabra</label>
        <input type="text" class="palabra form-control">
        <textarea rows="4" style="width: 50%;" class="definicion form-control" placeholder="Escribe la definición aquí"></textarea>
      </div>
    </div>

    <div class="col-md-4">

      <div class="row">

        <div class="col-md-9">
          <label for="fuente">Fuente</label>
          <div class="fuente form-control"></div>
        </div>
        <div class="col-md-3">
          <div class="round-button rbfuente"><div class="round-button-circle btn-primary"><a data-toggle="modal" data-target="#modal_3" class="round-button"><i class="fa fa-pencil"></i></a></div></div>
        </div>
      </div>
    </div>

<!--MODAL -->
  <div id="modal_3" class="modal fade" role="dialog">
    <input type="hidden" class="type_apa" value="">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FORMATO APA</h4>
          <select class="selectpicker" data-style="btn-primary" onchange="getModalBody(3)" title="¿Que quieres citar?">
            <option data-content='<i class="fa fa-book" aria-hidden="true"></i> Libro Electrónico'>libro</option>
            <option data-content='<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                Revista Científica Electrónica'>revista</option>
            <option data-content='<i class="fa fa-globe" aria-hidden="true"></i> Página Web' >web</option>
          
          </select>
        </div>
     
        <div class="modal-body">
          <!--BODY DEL MODAL-->
        
          <!--FIN BODY-->


        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" onClick="makeFormat('3')">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
  
      </div>

    </div>
  </div>

  </div>
  
  <!--FIN FORM 3-->
</div>

<button class="btn btn-danger" onClick="addDefinitionForm();">Agregar Palabra <i class="fa fa-plus"></i></button>

<br>

<button onClick="prepareConceptos()">Enviar palabras</button>



<!--AREA DE PRUEBAS-->

@endsection