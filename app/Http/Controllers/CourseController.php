<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CourseController extends Controller
{
    // Listar os cursos
    public function index(){

      // Recuperar os registros do banco de dados
      // $courses = Course::where('id', 1000)->get();
      // $courses = course::paginate(10);
      $courses = Course::orderBy('id', 'DESC')->get();

      // Salvar log
      Log::info('Listar cursos.');

       //carregar a view
      return view('courses.index', ['courses' => $courses]);

    }


    
    // Visualizar os cursos
    public function show(Course $course){
        
      //   dd($request->course);
      //   Para recuperar co mais de uma condição 
      //   $course = Course::where('id', $request->course)->first();
      //   dd($course);

        // Salvar log
        Log::info('Visualisar cursos.', [ 'course_id' => $course->id]);

        //carrega a View
        return view('courses.show', ['course' => $course]);
     }



     // Carregar o formulario cadastrar novo curso
    public function create(){
        
        return view('courses.create');
     }



     // Cadastrar no banco de dados o novo curso
    public function store(CourseRequest $request){

       // Validar o formulário
       $request->validated();

       // Marca o ponto inicial de uma transação
       DB::beginTransaction();

       try {

           // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
           $course = Course::create([
               'name' => $request->name,
               'price' => $request->price,
           ]);

           // Operação é concluída com êxito
           DB::commit();

           // Salvar log
           Log::info('Curso cadastrado.', [ 'course_id' => $course->id]);

           // Redirecionar o usuário, enviar a mensagem de sucesso
           return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
       } catch (Exception $e) {

           // Operação não é concluída com êxito
           DB::rollBack();

           // Salvar log
           Log::notice('Curso não cadastrado.', [ 'error' => $e->getMessage()]);

           // Redirecionar o usuário, enviar a mensagem de erro
           return back()->withInput()->with('error', 'Curso não cadastrado!');
       }
  }
 


     // Carrega o formulario para editar
    public function edit(Course $course){

        // Carrega a view
        return view('courses.edit', ['course' => $course]);
     }



      // Editar no banco de dados o curso
    public function update(CourseRequest $request, Course $course){

      // Marca o ponto inicial de uma transação
      DB::beginTransaction();

      try {

          // Validar o formulário
          $request->validated();

          // Editar as informações do registro no banco de dados
          $course->update([
              'name' => $request->name,
              'price' => $request->price,
          ]);

          // Operação é concluída com êxito
          DB::commit();

          // Salvar log
          Log::info('Curso editado.', [ 'course_id' => $course->id]);

          // Redirecionar o usuário, enviar a mensagem de sucesso
          return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
      } catch (Exception $e) {

          // Operação não é concluída com êxito
          DB::rollBack();

          // Salvar log
          Log::notice('Curso não editado.', [ 'error' => $e->getMessage()]);

          // Redirecionar o usuário, enviar a mensagem de erro
          return back()->withInput()->with('error', 'Curso não editado!');
      }
  }
 


     //Exclui no banco de dados
     public function destroy(Course $course)
     {
        
      try {

        // Excluir o registro do banco de dados
        $course->delete();

        // Salvar log
        Log::info('Curso apagado.', [ 'course_id' => $course->id]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('course.index')->with('success', 'Curso apagado com sucesso!');
      } catch (Exception $e) {

        // Salvar log
        Log::notice('Curso não apagado.', [ 'error' => $e->getMessage()]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('course.index')->with('error', 'Curso não apagado!');
      }

    }
 
}
