<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Pista;
use App\Models\Escuela;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\CategoriasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Adrian',
            'email' => 'adrian@yopmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('patin'),
            'rol' => 0,
        ]);

        User::create([
            'name' => 'Soraya',
            'email' => 'soraya@yopmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('patin'),
            'rol' => 0,
        ]);

        Pista::create([
            'nombre' => "Cesope",
            'direccion' => "Centro Social Peñarol en Sayago",
            'descripcion' => "-"
        ]);

        Pista::create([
            'nombre' => "Club Platense",
            'direccion' => "Centro",
            'descripcion' => "-"
        ]);

        $zona = "-";
        $nombre = "FEDERACION URUGUAYA DE PATINAJE";
        $email = "federacion@yopmail.com";

        Escuela::create([
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'contacto' => "-"
        ]);
        
        $escuela = Escuela::latest('id')->first();

        User::create([
            'name' => $nombre,
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("123456"),
            'rol' => $escuela->id,
        ]);
        echo "Escuela: $escuela->id - $nombre\n";
    
        $filePath = 'public/escuelas.csv';
        
        if (file_exists($filePath)) {
            $handle = fopen($filePath, 'r');
        
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // Procesa cada línea
                    $valores = str_getcsv($line, ';');
                    
                    //print_r($valores);
                    //$fecha = Carbon::createFromFormat('d/m/y', $valores[0])->format('Y-m-d');
                    $zona = $valores[0];
                    $nombre = $valores[1];
                    $email = $valores[2];
                    //echo "Zona: $zona <BR>";
                    //echo "Nombre $nombre <BR>";
                    //echo "Email $email <BR>";

                    Escuela::create([
                        'nombre' => $nombre,
                        'slug' => Str::slug($nombre),
                        'contacto' => "-"
                    ]);
                    
                    $escuela = Escuela::latest('id')->first();
            
                    User::create([
                        'name' => $nombre,
                        'email' => $email,
                        'email_verified_at' => Carbon::now(),
                        'password' => Hash::make("123456"),
                        'rol' => $escuela->id,
                    ]);
                    echo "Escuela: $escuela->id - $nombre\n";
                }

                fclose($handle);
            } else {
                // Error al abrir el archivo
                echo "No se pudo abrir el archivo. [$filePath]";
            }
        } else {
            echo "Archivo no encontrado. [$filePath]";
        }

        $filePath = 'public/formativas.csv';
        
        if (file_exists($filePath)) {
            $handle = fopen($filePath, 'r');
        
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // Procesa cada línea
                    $valores = str_getcsv($line, ';');
                    
                    //print_r($valores);
                    //$fecha = Carbon::createFromFormat('d/m/y', $valores[0])->format('Y-m-d');
                    $nombre = $valores[0];
                    $tipo = "F";

                    Categoria::create([
                        'nombre' => $nombre,
                        'slug' => Str::slug($nombre),
                        'tipo' => $tipo
                    ]);
                }
                echo "Categorías formativas creadas Ok \n";
                fclose($handle);
            } else {
                // Error al abrir el archivo
                echo "No se pudo abrir el archivo. [$filePath]";
            }
        } else {
            echo "Archivo no encontrado. [$filePath]";
        }

        $filePath = 'public/federal.csv';
        
        if (file_exists($filePath)) {
            $handle = fopen($filePath, 'r');
        
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // Procesa cada línea
                    $valores = str_getcsv($line, ';');
                    
                    //print_r($valores);
                    //$fecha = Carbon::createFromFormat('d/m/y', $valores[0])->format('Y-m-d');
                    $nombre = $valores[0];
                    $tipo = "D";

                    Categoria::create([
                        'nombre' => $nombre,
                        'slug' => Str::slug($nombre),
                        'tipo' => $tipo
                    ]);
                }
                echo "Categorías federales creadas Ok \n";
                fclose($handle);
            } else {
                // Error al abrir el archivo
                echo "No se pudo abrir el archivo. [$filePath]";
            }
        } else {
            echo "Archivo no encontrado. [$filePath]";
        }

    
        //$this->call(SalarioSeeder::class);
        //$this->call(CategoriasSeeder::class);
    }
}
