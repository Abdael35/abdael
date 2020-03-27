<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Casilla;
class CasillaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
    $casillas = Casilla::all();
    return view('casilla/list', compact('casillas'));
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('casilla/create');
}
/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request
* @return \Illuminate\Http\Response $request
*/
public function store(Request $request)
{
    $validacion = $request->validate([
        'ubicacion' => 'required|max:100',
    ]);

    $casilla = Casilla::create($validacion);

    return redirect('casilla')->with('success',
    $casilla->ubicacion .
    ' guardado satisfactoriamente ...');
}

/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    //
}
/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/

public function edit($id)
{
    $casilla = Casilla::find($id);
    return view('casilla/edit',
        compact('casilla'));
}
/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request
* @param int $request $id
* @return \Illuminate\Http\Response
*/

public function update(Request $request, $id)
{
    $validacion = $request->validate([
        'ubicacion' => 'required|max:100',
]);

Casilla::whereId($id)->update($validacion);
return redirect('casilla')
    ->with('success', 'Actualizado correctamente...');
}
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/

    public function destroy($id)
    {
        $casilla = Casilla::find($id);
        $casilla->delete();
        return redirect('casilla');
    }
} //--- end class
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casilla</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Casilla</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Casilla <span class="sr-only">(current)</span> </a>
      </li>
      <li class="nav-item">
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