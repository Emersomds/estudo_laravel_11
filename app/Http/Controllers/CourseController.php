<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
       //carregar a view
       return view('courses.index');
    }


    
    // Visualizar os cursos
    public function show(){
        
        return view('courses.show');
     }



     // Carregar o formulario cadastrar novo curso
    public function create(){
        
        return view('courses.create');
     }



     // Cadastrar no banco de dados o novo curso
    public function store(Request $request){

      // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
      // dd($request->name);
      Course::create([
          'name' => $request->name
      ]);
      
      // Redirecionar o usuário, enviar a mensagem de sucesso
      return redirect()->route('courses.create')->with('success', 'Curso cadastrado com sucesso!');
  }
 


     // Carrega o formulario para editar
    public function edit(){
        
        return view('courses.edit');
     }



     //Edita no Banco de Dados
     public function update(){
        
        dd("Editar o curso no Banco de Dados");
     }
 


     //Exclui no banco de dados
     public function destroy(){
        
        dd("Exclui o curso no Banco de Dados");
     }
 
}
