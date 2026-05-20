<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CongeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Congés annuels approuvés
            [
                'employe_id'     => 1,
                'type_conge_id'  => 1,
                'date_debut'     => '2026-05-01',
                'date_fin'       => '2026-05-10',
                'nb_jours'       => 10,
                'motif'          => 'Vacances en famille',
                'statut'         => 'approuvee',
                'commentaire_rh' => 'Approuvé - couverture assurée',
                'created_at'     => '2026-04-20 10:00:00',
                'traite_par'     => 2,
            ],
            [
                'employe_id'     => 2,
                'type_conge_id'  => 1,
                'date_debut'     => '2026-06-15',
                'date_fin'       => '2026-06-25',
                'nb_jours'       => 11,
                'motif'          => 'Voyage professionnel personnel',
                'statut'         => 'approuvee',
                'commentaire_rh' => 'Approuvé',
                'created_at'     => '2026-05-10 09:30:00',
                'traite_par'     => 2,
            ],
            // Congé maladie approuvé
            [
                'employe_id'     => 3,
                'type_conge_id'  => 2,
                'date_debut'     => '2026-05-11',
                'date_fin'       => '2026-05-13',
                'nb_jours'       => 3,
                'motif'          => 'Grippe - certificat médical fourni',
                'statut'         => 'approuvee',
                'commentaire_rh' => 'Approuvé - justificatif fourni',
                'created_at'     => '2026-05-11 08:00:00',
                'traite_par'     => 2,
            ],
            // Congé maternité
            [
                'employe_id'     => 2,
                'type_conge_id'  => 3,
                'date_debut'     => '2026-07-01',
                'date_fin'       => '2026-10-30',
                'nb_jours'       => 122,
                'motif'          => 'Congé maternité légal',
                'statut'         => 'approuvee',
                'commentaire_rh' => 'Approuvé - congé maternité',
                'created_at'     => '2026-05-01 11:00:00',
                'traite_par'     => 2,
            ],
            // Congé en attente de validation
            [
                'employe_id'     => 1,
                'type_conge_id'  => 1,
                'date_debut'     => '2026-08-01',
                'date_fin'       => '2026-08-15',
                'nb_jours'       => 15,
                'motif'          => 'Vacances d\'été',
                'statut'         => 'en_attente',
                'commentaire_rh' => null,
                'created_at'     => '2026-05-18 14:30:00',
                'traite_par'     => null,
            ],
            // Congé refusé
            [
                'employe_id'     => 3,
                'type_conge_id'  => 1,
                'date_debut'     => '2026-05-20',
                'date_fin'       => '2026-05-27',
                'nb_jours'       => 8,
                'motif'          => 'Séminaire privé',
                'statut'         => 'refusee',
                'commentaire_rh' => 'Refusé - période critique pour l\'équipe',
                'created_at'     => '2026-05-19 10:00:00',
                'traite_par'     => 2,
            ],
            // Congé annulé
            [
                'employe_id'     => 3,
                'type_conge_id'  => 1,
                'date_debut'     => '2026-07-10',
                'date_fin'       => '2026-07-20',
                'nb_jours'       => 11,
                'motif'          => 'Vacances', 
                'statut'         => 'annulee',
                'commentaire_rh' => 'Annulé à la demande de l\'employé',
                'created_at'     => '2026-04-15 09:00:00',
                'traite_par'     => 2,
            ],
            // Autre congé en attente
            [
                'employe_id'     => 2,
                'type_conge_id'  => 2,
                'date_debut'     => '2026-05-22',
                'date_fin'       => '2026-05-22',
                'nb_jours'       => 1,
                'motif'          => 'Consultation médicale',
                'statut'         => 'en_attente',
                'commentaire_rh' => null,
                'created_at'     => '2026-05-19 16:45:00',
                'traite_par'     => null,
            ],
        ];

        $this->db->table('conges')->insertBatch($data);
    }
}
