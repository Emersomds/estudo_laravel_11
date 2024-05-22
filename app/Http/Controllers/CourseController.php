<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    // Listar os cursos
    public function index(){

      // Recuperar os registros do banco de dados
      // $courses = Course::where('id', 1000)->get();
      // $courses = course::paginate(10);
      $courses = Course::orderBy('id', 'DESC')->get();

       //carregar a view
      return view('courses.index', ['courses' => $courses]);

    }


    
    // Visualizar os cursos
    public function show(Course $course){
        
      //   dd($request->course);
      //   Para recuperar co mais de uma condição 
      //   $course = Course::where('id', $request->course)->first();
      //   dd($course);

        //carrega a View
        return view('courses.show', ['course' => $course]);
     }



     // Carregar o formulario cadastrar novo curso
    public function create(){
        
        return view('course.create');
     }



     // Cadastrar no banco de dados o novo curso
    public function store(CourseRequest $request){

      $request->validated();

      // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
      // dd($request->name);
      Course::create([
          'name' => $request->name,
          'price' => $request->price,
      ]);
      
      // Redirecionar o usuário, enviar a mensagem de sucesso
      return redirect()->route('course.create')->with('success', 'Curso cadastrado com sucesso!');
  }
 


     // Carrega o formulario para editar
    public function edit(Course $course){

        // Carrega a view
        return view('courses.edit', ['course' => $course]);
     }



      // Editar no banco de dados o curso
    public function update(CourseRequest $request, Course $course){

      //Validar o formulariio
      $request->validated();

      // Editar as informações do registro no banco de dados
      $course->update([
          'name' => $request->name,
          'price' => $request->price,
      ]);

      // Redirecionar o usuário, enviar a mensagem de sucesso
      return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
      
  }
 


     //Exclui no banco de dados
     public function destroy(Course $course){
        
      try {

        // Excluir o registro do banco de dados
        $course->delete();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('course.index')->with('success', 'Curso apagado com sucesso!');
        
      } catch (Exception $e) {

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('course.index')->with('error', 'Curso não apagado!');
      }

    }
 
}
