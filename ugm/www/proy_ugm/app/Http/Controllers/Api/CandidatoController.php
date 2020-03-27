<?php
    namespace App\Http\Controllers\Api;
    use App\Http\Controllers\Api\GenericController as GenericController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use App\Models\Candidato;
    class CandidatoController extends GenericController
    {
        
        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */

        public function index() {

            $candidatos = Candidato::all();
            return view('candidato/list', compact('candidatos'));


            //$candidatos = Candidato::all();
            //$resp = $this->sendResponse($candidatos, "Listado de candidatos");
            //return ($resp);
        }

        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create() {
            return view('candidato/create');
        }

        /**
        * Store a newly created resource in storage.
        * @param \Illuminate\Http\Request $request
        * @return \Illuminate\Http\Response
        */

        public function store(Request $request) {
            $validacion = Validator::make($request->all(), [
            'nombrecompleto' => 'unique:candidato|required|max:200',
            'sexo' =>'required'
        ]);

        if ($validacion->fails())
        return $this->sendError("Error de validacion", $validacion->errors());

        $fotocandidato=""; $perfilcandidato="";

        if ($request->hasFile('foto')){
            $foto = $request->file('foto');
            $fotocandidato = $foto->getClientOriginalName();
        }
        if ($request->hasFile('perfil')){
            $perfil = $request->file('perfil');
            $perfilcandidato = $perfil->getClientOriginalName();
        }

        $campos = array(
            'nombrecompleto' => $request->nombrecompleto,
            'sexo' => $request->sexo,
            'foto' => $fotocandidato,
            'perfil' => $perfilcandidato,
        );

        if ($request->hasFile('foto')) $foto->move(public_path('img'), $fotocandidato);
        if ($request->hasFile('perfil')) $perfil->move(public_path('img'), $perfilcandidato);
        $candidato = Candidato::create($campos);
        $resp = $this->sendResponse($candidato, "Guardado...");
        return redirect('api/candidato')
                ->with('success', 'Guardado correctamente...');
    } //--- End store
    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function show($id) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id) {
        $candidato = Candidato::find($id);
        return view('candidato/edit',
        compact('candidato'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request
    * @param int $request $id
    * @return \Illuminate\Http\Response
    */

    public function update(Request $request, $id) {
        $validacion = $request->validate([
            'nombrecompleto' => 'required|max:100',
            'sexo' => 'required|max:1',
        ]);
    
        Candidato::whereId($id)->update($validacion);
        return redirect('api/candidato')
                ->with('success', 'Actualizado correctamente...');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
        $candidato = Candidato::find($id);
        $candidato->delete();
        return redirect('api/candidato');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Candidato</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Casilla</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Candidato</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Funcionario</a>
      </li>
    </ul>
  </div>
</nav>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>