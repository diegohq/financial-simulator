<?php

namespace App\Http\Controllers;

use App\Http\Requests\Simulation;
use App\Http\Transformer\Simulation as Transformer;
use App\Services\Applications\AnnualInterest;
use App\Services\Applications\Cdb;
use App\Services\Applications\Lc;
use App\Services\Applications\Lca;
use App\Services\Applications\Lci;
use App\Services\Applications\Raw;

class Simulators extends Controller
{
    public function __construct(
        private Transformer $transformer,
        private AnnualInterest $annualInterest
    ) {}

    /**
     * Calculate Raw application
     *
     * @param Simulation $request
     * @param Raw $application
     * @return array
     */
    public function raw(Simulation $request, Raw $application): array
    {
        return $this->transformer->transform(
            $application->calculate(
                $request->input('initial_amount'),
                $request->input('days'),
                $this->annualInterest->interest(
                    $request->input('annual_interest')
                ),
            )
        );
    }

    /**
     * Calculate LCI application
     *
     * @param Simulation $request
     * @param Lci $application
     * @return array
     */
    public function lci(Simulation $request, Lci $application): array
    {
        return $this->transformer->transform(
            $application->calculate(
                $request->input('initial_amount'),
                $request->input('days'),
                $this->annualInterest->interest(
                    $request->input('annual_interest')
                ),
            )
        );
    }

    /**
     * Calculate LCA application
     *
     * @param Simulation $request
     * @param Lca $application
     * @return array
     */
    public function lca(Simulation $request, Lca $application): array
    {
        return $this->transformer->transform(
            $application->calculate(
                $request->input('initial_amount'),
                $request->input('days'),
                $this->annualInterest->interest(
                    $request->input('annual_interest')
                ),
            )
        );
    }

    /**
     * Calculate CDB application
     *
     * @param Simulation $request
     * @param Cdb $application
     * @return array
     */
    public function cdb(Simulation $request, Cdb $application): array
    {
        return $this->transformer->transform(
            $application->calculate(
                $request->input('initial_amount'),
                $request->input('days'),
                $this->annualInterest->interest(
                    $request->input('annual_interest')
                ),
            )
        );
    }

    /**
     * Calculate LC application
     *
     * @param Simulation $request
     * @param Lc $application
     * @return array
     */
    public function lc(Simulation $request, Lc $application): array
    {
        return $this->transformer->transform(
            $application->calculate(
                $request->input('initial_amount'),
                $request->input('days'),
                $this->annualInterest->interest(
                    $request->input('annual_interest')
                ),
            )
        );
    }
}
