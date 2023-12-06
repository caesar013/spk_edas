<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link" href="{{route('dashboard.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Data</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Input
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" id="href_criteria" href="">Kriteria</a>
                        <a class="nav-link" id="href_alternative" href="">Alternatif</a>
                        <a class="nav-link" id="href_matrix" href="">Matriks
                            Keputusan</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Process
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" id="href_average" href="">Average</a>
                        <a class="nav-link" id="href_pda" href="">PDA</a>
                        <a class="nav-link" id="href_nda" href="">NDA</a>
                        <a class="nav-link" id="href_sp" href="">SP</a>
                        <a class="nav-link" id="href_sn" href="">SN</a>
                        <a class="nav-link" id="href_nsp" href="">NSP</a>
                        <a class="nav-link" id="href_nsn" href="">NSN</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Result</div>

                <a class="nav-link" id="href_apraisalscore" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Apraisal Score
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{Auth::user()->name}}
        </div>
    </nav>
</div>