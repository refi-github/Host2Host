<?php

namespace app\models;

use Yii;

class Dashboard extends \yii\db\ActiveRecord
{
    public static function getAll($partnerId = null)
    {
        $currentDate = date("Y-m-d");
        $currentMonth = date("m");
        $currentYear = date("Y");

        // Application Loan Amount
        $query = Application::find();
        if ($partnerId != null) {
            $query->where(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->where(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $applicationLoanAmount = $query->sum('loan_amount');
        
        // Application Total Accounts
        $query = Application::find();
        if ($partnerId != null) {
            $query->where(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->where(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $applicationTotalAccount = $query->count('id');

        // Today Application Loan Amount
        $query = Application::find();
        $query->where(['loan_date' => $currentDate]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $todayApplicationLoanAmount = $query->sum('loan_amount');
        
        // Today Application Total Accounts
        $query = Application::find();
        $query->where(['loan_date' => $currentDate]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $todayApplicationTotalAccount = $query->count('id');

        // This Month Application Loan Amount
        $query = Application::find();
        $query->where(['MONTH(loan_date)' => $currentMonth]);
        $query->andWhere(['YEAR(loan_date)' => $currentYear]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $thisMonthApplicationLoanAmount = $query->sum('loan_amount');
        
        // This Month Application Total Accounts
        $query = Application::find();
        $query->where(['MONTH(loan_date)' => $currentMonth]);
        $query->andWhere(['YEAR(loan_date)' => $currentYear]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $thisMonthApplicationTotalAccount = $query->count('id');

        // Disbursement Loan Amount
        $query = Disbursement::find();
        if ($partnerId != null) {
            $query->where(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->where(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $disbursementLoanAmount = $query->sum('amount');
        
        // Disbursement Total Accounts
        $query = Disbursement::find();
        if ($partnerId != null) {
            $query->where(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->where(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $disbursementTotalAccount = $query->count('id');

        // Today Disbursement Loan Amount
        $query = Disbursement::find();
        $query->where(['disbursement_date' => $currentDate]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $todayDisbursementLoanAmount = $query->sum('amount');
        
        // Today Disbursement Total Accounts
        $query = Disbursement::find();
        $query->where(['disbursement_date' => $currentDate]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $todayDisbursementTotalAccount = $query->count('id');

        // This Month Disbursement Loan Amount
        $query = Disbursement::find();
        $query->where(['MONTH(disbursement_date)' => $currentMonth]);
        $query->andWhere(['YEAR(disbursement_date)' => $currentYear]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $thisMonthDisbursementLoanAmount = $query->sum('amount');
        
        // This Month Disbursement Total Accounts
        $query = Disbursement::find();
        $query->where(['MONTH(disbursement_date)' => $currentMonth]);
        $query->andWhere(['YEAR(disbursement_date)' => $currentYear]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $thisMonthDisbursementTotalAccount = $query->count('id');
        
        // Payment Total Accounts
        $query = Payment::find();
        if ($partnerId != null) {
            $query->where(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->where(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $paymentTotalAccount = $query->count('id');
        
        // Today Payment Total Accounts
        $query = Payment::find();
        $query->where(['payment_date' => $currentDate]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $todayPaymentTotalAccount = $query->count('id');
        
        // This Month Payment Total Accounts
        $query = Payment::find();
        $query->where(['MONTH(payment_date)' => $currentMonth]);
        $query->andWhere(['YEAR(payment_date)' => $currentYear]);
        if ($partnerId != null) {
            $query->andWhere(['partner_id' => $partnerId]);
        } else if (isset(Yii::$app->user->identity->role) 
            && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
        }
        $thisMonthPaymentTotalAccount = $query->count('id');

        // Monthly Statistic
        $monthlyStatisticApplications = [];
        $monthlyStatisticApprovals = [];
        $monthlyStatisticDisbursements = [];

        for ($month = 1; $month <= 12; $month++) {
            $query = Application::find();
            $query->where(['MONTH(loan_date)' => $month]);
            $query->andWhere(['YEAR(loan_date)' => $currentYear]);
            if ($partnerId != null) {
                $query->andWhere(['partner_id' => $partnerId]);
            } else if (isset(Yii::$app->user->identity->role) 
                && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
                $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
            }
            $applicationAmountByMonth = $query->sum('loan_amount');
            $approvalAmountByMonth = $applicationAmountByMonth;
            
            $query = Disbursement::find();
            $query->where(['MONTH(disbursement_date)' => $month]);
            $query->andWhere(['YEAR(disbursement_date)' => $currentYear]);
            if ($partnerId != null) {
                $query->andWhere(['partner_id' => $partnerId]);
            } else if (isset(Yii::$app->user->identity->role) 
                && Yii::$app->user->identity->role == User::ROLE_PARTNER) {
                $query->andWhere(['partner_id' => Yii::$app->user->identity->partner_id]);
            }
            $disbursementAmountByMonth = $query->sum('amount');

            $monthlyStatisticApplications[] = ($applicationAmountByMonth > 0) ? $applicationAmountByMonth : 0;
            $monthlyStatisticApprovals[] = ($approvalAmountByMonth > 0) ? $approvalAmountByMonth : 0;
            $monthlyStatisticDisbursements[] = ($disbursementAmountByMonth > 0) ? $disbursementAmountByMonth : 0;
        }

        return [
            'applicationLoanAmount' => self::formattedPrice($applicationLoanAmount),
            'applicationTotalAccount' => $applicationTotalAccount,
            'todayApplicationLoanAmount' => self::formattedPrice($todayApplicationLoanAmount),
            'todayApplicationTotalAccount' => $todayApplicationTotalAccount,
            'thisMonthApplicationLoanAmount' => self::formattedPrice($thisMonthApplicationLoanAmount),
            'thisMonthApplicationTotalAccount' => $thisMonthApplicationTotalAccount,
            'disbursementLoanAmount' => self::formattedPrice($disbursementLoanAmount),
            'disbursementTotalAccount' => $disbursementTotalAccount,
            'todayDisbursementLoanAmount' => self::formattedPrice($todayDisbursementLoanAmount),
            'todayDisbursementTotalAccount' => $todayDisbursementTotalAccount,
            'thisMonthDisbursementLoanAmount' => self::formattedPrice($thisMonthDisbursementLoanAmount),
            'thisMonthDisbursementTotalAccount' => $thisMonthDisbursementTotalAccount,
            'paymentTotalAccount' => $paymentTotalAccount,
            'todayPaymentTotalAccount' => $todayPaymentTotalAccount,
            'thisMonthPaymentTotalAccount' => $thisMonthPaymentTotalAccount,
            'monthlyChart' => [
                'applications' => $monthlyStatisticApplications,
                'approvals' => $monthlyStatisticApprovals,
                'disbursements' => $monthlyStatisticDisbursements,
            ],
        ];
    }

    public static function formattedPrice($price)
    {
        $price = ($price > 0) ? $price : 0;

        if ($price >= 1000000000000) {
            return round($price / 1000000000000, 1) . ' Trillion'; 
        }

        if ($price >= 1000000000) {
            return round($price / 1000000000, 1) . ' Billion'; 
        }

        if ($price >= 1000000) {
            return round($price / 1000000, 1) . ' Million'; 
        }

        if ($price >= 1000) {
            return round($price / 1000, 1) . ' Thousand'; 
        }

        return $price; 
    }
}