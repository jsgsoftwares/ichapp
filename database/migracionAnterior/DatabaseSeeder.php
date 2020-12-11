<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //CUANDO NO LEE LOS SEEDERS EN PRODUCCION
    //paso 1 : composer dump-autoload y listo
    public function run()
    {
        $this->call(CompanieTableSeeder ::class);
        $this->call(RolesTableSeeder ::class);
        $this->call(DocumentoTableSeeder::class);
        $this->call(GenerosTableSeeder ::class);
        $this->call(PaisesTableSeeder ::class);
        $this->call(CanalesTableSeeder ::class);
        $this->call(StatesTableSeeder ::class);
        $this->call(UsersTableSeeder ::class);
        $this->call(ConversationTableSeeder ::class);
        $this->call(MessagesTableSeeder ::class);
        $this->call(FlujosTableSeeder ::class);
        $this->call(ClienteschatTableSeeder ::class);
        $this->call(FullfillmantTableSeeder ::class);
        $this->call(TipoConsultasTableSeeder::class);
        $this->call(MensajePredeterminadoTableSeeder::class);
        $this->call(WaboxappTableSeeder::class);
        $this->call(AccionesModulosTableSeeder::class);
        $this->call(IntegrationstelegramTableSeeder::class);
        $this->call(IntegrationswapingTableSeeder::class);
        $this->call(AibotTableSeeder::class);
        $this->call(BotflowTableSeeder::class);
        $this->call(IntegrationsTableSeeder::class);
        $this->call(IntegrationswebhookTableSeeder::class);
        $this->call(FlujoModuleTableSeeder::class);
        $this->call(WapingTokensTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(SubscripcionTableSeeder::class);
        $this->call(PlansmigracionTableSeeder::class);
        $this->call(ProductsubscriptosTableSeeder::class);
        
    }
}
