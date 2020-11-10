<?

 class EndpointConstant
 {
      public function BaseUrl ($instance, $customerId)
      {
          return "https://{$instance}-api.private.fin.ag/v3/{$customerId}/";
      }
      const Authorize = "BankingServices/Authorize";
      const GetAccountsSummary = "BankingServices/GetAccountsSummary";
      const GetAccountsDetail = "BankingServices/GetAccountsDetail ";
      const GetAccountsDetailAsync = "BankingServices/GetAccountsDetailAsync";
      const GetStatements = "BankingServices/GetStatements";
      const GetStatementsAsync = "BankingServices/GetStatementsAsync";
      const SetScheduledRefresh = "BankingServices/SetScheduledRefresh";
      const DeleteCard = "BankingServices/DeleteCard";
      const GetScore = "Insight/login/{LoginId}/score/{RequestId}";
      const GetAttribute = "Insight/login/{LoginId}/attributes/{RequestId}";
      const GenerateAuthorizeToken = "BankingServices/GenerateAuthorizeToken";


 }