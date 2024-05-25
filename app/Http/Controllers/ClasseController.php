<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClasseController extends Controller
{
    public function index(Course $course)
    {
        
        // Recuperar as aulas do banco de dados
        $classes = Classe::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_classe')
            ->paginate(10);

         // Salvar log
        Log::info('Listar aulas.', ['course_id' => $course->id]);

        // Carregar a VIEW
        return view('classes.index', ['course'=> $course,'classes' => $classes]);
    }

     // Detalhes da aula
     public function show(Classe $classe)
     {

        // Salvar log
        Log::info('Visualizar a aula.', [ 'classe_id' => $classe->id]);

         // Carregar a VIEW
         return view('classes.show', ['classe' => $classe]);
     }

    //Carregar o formulario cadstrar nova aula
    public function create(Course $course)
    {
        //Carrega a view.
        return view('classes.create', ['course' => $course]);
    }

    //cadastrar no banco de dados a nova aula
    public function store(ClasseRequest $request)
    {
        //VAlidar o formulario
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Recuperar a última ordem da aula no curso
            $lastOrderClasse = Classe::where('course_id', $request->course_id)
                ->orderBy('order_classe', 'DESC')
                ->first();
            // dd($lastOrderClasse);

            // Cadastrar no banco de dados na tabela aulas
            Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
                'course_id' => $request->course_id
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Aula cadastrada.', [ 'classe_id' => $request->course_id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Curso cadastrado com sucesso!');
            
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Salvar log
            Log::notice('Aula não cadastrada.', [ 'error' => $e->getMessage() ]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não cadastrada!');
        }   
    }


    // Carregar o formulario editar aula.
    public function edit( Classe $classe)
    {

        // Carregar a view
        return view('classes.edit', ['classe' => $classe]);
    }

    public function update(ClasseRequest $request, Classe $classe)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $classe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

           // Operação é concluída com êxito
           DB::commit();

           // Salvar log
           Log::info('Aula editada.', [ 'classe_id' => $classe->id]);

           // Redirecionar o usuário, enviar a mensagem de sucesso
           return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
       } catch (Exception $e) {

           // Operação não é concluída com êxito
           DB::rollBack();

           // Salvar log
           Log::notice('Aula não editada.', [ 'error' => $e->getMessage()]);

           // Redirecionar o usuário, enviar a mensagem de erro
           return back()->withInput()->with('error', 'Aula não editada!');
       }
    }

    // Apagar a aula do registro e bd>
        
    public function destroy(Classe $classe)
    {

        try{
           // Excluir o registro do banco de dados
           $classe->delete();

           // Salvar log
           Log::info('Aula apagada.', [ 'classe_id' => $classe->id]);

           // Redirecionar o usuário, enviar a mensagem de sucesso
           return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula apagada com sucesso!');
       } catch (Exception $e) {

           // Salvar log
           Log::notice('Aula não apagada.', [ 'error' => $e->getMessage()]);

           // Redirecionar o usuário, enviar a mensagem de sucesso
           return redirect()->route('classe.index', ['course' => $classe->course_id])->with('error', 'Aula não apagada!');
       }
        
        
    }

}
