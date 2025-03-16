
<h5 class="fs-16">
    {{ $grade->student->last_name.' '.$grade->student->first_name.' '.$grade->student->other_name  }}
</h5>
<div class="row">
    <input type="hidden" value="{{ $grade->id }}" name="id" id="id" >
    <div class="col-lg-3 col-sm-12">
        <label for="">Ca1</label>
        <input type="number" class="form-control ca1 cabox" value="{{ $grade->ca1 }}" name="ca1" id="ca1" onkeypress="return isNumber(event)" >
    </div>
    <div class="col-lg-3 col-sm-12">
        <label for="">Ca2</label>
        <input type="number" class="form-control ca2 cabox" value="{{ $grade->ca2 }}" name="ca2" id="ca2" onkeypress="return isNumber(event)" >
    </div>
    <div class="col-lg-3 col-sm-12">
        <label for="">Ca3</label>
        <input type="number" class="form-control ca3 cabox" value="{{ $grade->ca3 }}" name="ca3" id="ca3" onkeypress="return isNumber(event)" >
    </div>
    <div class="col-lg-3 col-sm-12">
        <label for="">Exams</label>
        <input type="number" class="form-control exam cabox" value="{{ $grade->exam }}" name="exam" id="exam" onkeypress="return isNumber(event)" >
    </div>
</div>
