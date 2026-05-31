<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIGejalaController extends Controller
{
    public function index()
    {
        return view('dashboard.role.pasien.cek-gejala-ai');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $prompt = strtolower($request->message);
        
        // Mock AI Logic Dictionary
        $diseaseResponses = [
            'batuk' => 'Batuk biasanya disebabkan oleh infeksi saluran pernapasan, paparan debu/alergi, atau naiknya asam lambung.',
            'pusing' => 'Pusing atau sakit kepala bisa dipicu oleh kelelahan, kurang istirahat, stres, atau tekanan darah yang tidak stabil.',
            'sakit kepala' => 'Sakit kepala bisa dipicu oleh kelelahan, kurang istirahat, stres, atau tekanan darah yang tidak stabil.',
            'demam' => 'Demam merupakan respons alami tubuh saat sedang melawan infeksi bakteri atau virus.',
            'sakit perut' => 'Sakit perut seringkali berasal dari masalah pencernaan, asam lambung tinggi, atau keracunan makanan.',
            'mual' => 'Mual seringkali berkaitan dengan gangguan lambung, maag, atau gejala awal masuk angin dan infeksi.',
            'diare' => 'Diare umumnya disebabkan oleh infeksi bakteri dari makanan yang kurang bersih atau intoleransi makanan.',
            'gatal' => 'Gatal pada kulit bisa merupakan reaksi alergi, infeksi jamur, atau akibat gigitan serangga.',
            'sesak' => 'Sesak napas bisa menjadi tanda adanya asma, reaksi alergi berat, atau gangguan pada paru-paru dan saluran napas.',
            'flu' => 'Flu disebabkan oleh virus dan umumnya membaik dengan istirahat total serta memperbanyak minum air putih.',
            'pilek' => 'Pilek adalah infeksi virus ringan pada saluran pernapasan atas (hidung dan tenggorokan).',
            'nyeri' => 'Nyeri pada persendian atau otot tubuh bisa disebabkan oleh ketegangan berlebih, peradangan, atau postur yang salah.',
            'darah' => 'Gejala yang melibatkan perdarahan atau kelainan darah sangat bervariasi penyebabnya dan butuh pemeriksaan fisik.'
        ];

        $matchedResponse = null;
        foreach ($diseaseResponses as $keyword => $response) {
            if (str_contains($prompt, $keyword)) {
                $matchedResponse = $response;
                break;
            }
        }
        
        $generalHealthKeywords = ['sakit', 'gejala', 'obat', 'dokter', 'luka', 'mata', 'telinga', 'hidung', 'kulit', 'alergi', 'kesehatan', 'penyakit', 'virus', 'infeksi', 'badan'];
        $isGeneralHealth = false;
        foreach ($generalHealthKeywords as $keyword) {
            if (str_contains($prompt, $keyword)) {
                $isGeneralHealth = true; 
                break;
            }
        }

        $recommendation = " Namun perlu diingat, saya adalah asisten AI dan ini bukanlah diagnosis medis yang pasti. Sangat disarankan agar Anda segera menghubungi dan membuat janji temu dengan dokter yang berpengalaman di platform ini untuk mendapatkan pemeriksaan lebih lanjut.";

        if ($matchedResponse) {
            $reply = $matchedResponse . $recommendation;
        } elseif ($isGeneralHealth) {
            $reply = "Mengenai keluhan Anda, ada banyak kemungkinan faktor medis yang bisa menjadi penyebabnya." . $recommendation;
        } else {
            $reply = "Maaf, saya hanya diprogram untuk menjawab perihal penyakit dan gejala kesehatan yang Anda derita. Silakan tanyakan keluhan medis Anda.";
        }

        // Simulate network delay for realism
        usleep(500000); // 0.5s delay
        
        return response()->json([
            'reply' => $reply
        ]);
    }
}
