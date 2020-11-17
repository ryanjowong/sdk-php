<?php

namespace Flinks;

 class EndpointConstant
 {
      public function BaseUrl (string $instance, string $customerId)
      {
          return "https://{$instance}-api.private.fin.ag/v3/{$customerId}/";
      }
      const Authorize = "BankingServices/Authorize";
      const GetAccountsSummary = "BankingServices/GetAccountsSummary";
      const GetAccountsSummaryAsync = "BankingServices/GetAccountsSummaryAsync/";
      const GetAccountsDetail = "BankingServices/GetAccountsDetail";
      const GetAccountsDetailAsync = "BankingServices/GetAccountsDetailAsync/";
      const GetStatements = "BankingServices/GetStatements";
      const SetScheduledRefresh = "BankingServices/SetScheduledRefresh";
      const DeleteCard = "BankingServices/DeleteCard";
      const GetScore = "Insight/login/{LoginId}/score/{RequestId}";
      const GetAttribute = "Insight/login/{LoginId}/attributes/{RequestId}";
      const GenerateAuthorizeToken = "BankingServices/GenerateAuthorizeToken";

 }