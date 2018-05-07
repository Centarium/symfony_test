<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Client;
use App\Entity\Invoice;
use App\Entity\Invoice_Details;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

final class Version20180505165937 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function up(Schema $schema) : void
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $dc = $this->container->get('doctrine');
        $user = $dc->getRepository(User::class)->find(5);
        $clientRepository = $dc->getRepository(Client::class);
        $invoiceRepository = $dc->getRepository(Invoice::class);
        $serviceRepository = $dc->getRepository(Service::class);


        $clients = [
            [
                'create_user' => $user,
                'name' => 'Лента',
                'gln' => '3407586789',
                'timestamp' => 'NOW()',
                'juridical_address' => 'Заречная',
                'physical_address' => 'Гельсингфорская'
            ],
            [
                'create_user' => $user,
                'name' => 'X5',
                'gln' => '5467567568',
                'timestamp' => 'NOW()',
                'juridical_address' => 'Заречная',
                'physical_address' => 'Гельсингфорская'
            ]
        ];

        $services = [
            [
                'service_name' => 'Электронный документооборот',
                'default_price' => 340.2,
                'period' => 1
            ],
            [
                'service_name' => 'Цифровая подпись',
                'default_price' => 1000.5,
                'period' => 1
            ]
        ];

        $invoices = [
            [
                'create_user' => $user,
                'invoice_nr' => 4567,
                'comment' => 'УПД'
            ],
            [
                'create_user' => $user,
                'invoice_nr' => 9673,
                'comment' => 'Invoice'
            ]
        ];

        $invDetails = [
            [
                'net_amount' => 1850,
                'tax_amount' => 150,
                'gross_amount' => 2000,
                'qty' => 5,
                'tax_rate' => 20
            ],
            [
                'net_amount' => 3000,
                'tax_amount' => 400,
                'gross_amount' => 1000,
                'qty' => 10,
                'tax_rate' => 0
            ]
        ];

        $clientIDs = $serviceIDs = $invoiceIDs = [];


        foreach ($clients as $client)
        {
            $clientModel = new Client();

            $clientModel->setGln( $client['gln'] );
            $clientModel->setJuridicalAddress( $client['juridical_address'] );
            $clientModel->setName($client['name']);
            $clientModel->setPhysicalAddress($client['physical_address']);
            $clientModel->setCreateUser($client['create_user']);
            $clientModel->setTimestamp();

            $em->persist($clientModel);
            $em->flush();

            $id = $em->getConnection()->lastInsertId();

            $clientIDs[] = $id;
        }

        foreach ($services as $service)
        {
            $serviceModel = new Service();

            $serviceModel->setDefaultPrice($service['default_price']);
            $serviceModel->setPeriod($service['period']);
            $serviceModel->setServiceName($service['service_name']);

            $em->persist($serviceModel);
            $em->flush();

            $id = $em->getConnection()->lastInsertId();

            $serviceIDs[] = $id;
        }

        foreach ($invoices as $invoice)
        {
            $invoiceModel = new Invoice();

            $invoiceModel->setCreateUser($invoice['create_user']);
            $invoiceModel->setClientId( $clientRepository->find(array_shift($clientIDs)) );
            $invoiceModel->setInvoiceNr($invoice['invoice_nr']);
            $invoiceModel->setComment($invoice['comment']);
            $invoiceModel->setTimestamp();

            $em->persist($invoiceModel);
            $em->flush();

            $id = $em->getConnection()->lastInsertId();

            $invoiceIDs[] = $id;
        }

        foreach ($invDetails as $invDetail) {
            $invDetailsModel = new Invoice_Details();

            $invDetailsModel->setGrossAmount($invDetail['gross_amount']);
            $invDetailsModel->setNetAmount($invDetail['net_amount']);
            $invDetailsModel->setQty($invDetail['qty']);
            $invDetailsModel->setTaxAmount($invDetail['tax_amount']);
            $invDetailsModel->setTaxRate($invDetail['tax_rate']);

            $invDetailsModel->setInvoiceId( $invoiceRepository->find(array_shift($invoiceIDs)) );
            $invDetailsModel->setServiceId( $serviceRepository->find(array_shift($serviceIDs)) );
        }

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE invoice CASCADE');
        $this->addSql('TRUNCATE invoice_details CASCADE');
        $this->addSql('TRUNCATE service CASCADE');
        $this->addSql('TRUNCATE client CASCADE');
    }
}
