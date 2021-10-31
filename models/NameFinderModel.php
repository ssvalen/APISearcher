<?php 

class NameFinderModel {

    public function executeSoapRequest($name = '')
    {
        
        try {
            
            $context = stream_context_create([
                'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ]);
            $input = ['name' => $name];
            $client = new SoapClient('http://www.crcind.com/csp/samples/SOAP.Demo.CLS?WSDL', ['stream_context' => $context]);
            $result = $client->GetListByName($input);
    
            return $result;

        } catch (Exception $e) {
            
            return 500;
        }

    

        
    }
    public function getPersonName($name = '')
    {
      $response = $this->executeSoapRequest($name );

      $data = json_decode(json_encode($response), true);
      if(!empty($data) && $data != 500) return $data['GetListByNameResult']['PersonIdentification'];
      else return 404;
        
    }
}

?>