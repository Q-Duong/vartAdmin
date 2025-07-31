@extends('layouts.default_auth')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Thống kê Hội nghị
        </div>
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <div class="filter-title">
                            <p class="filter-title-text">
                                Counting Statistics
                            </p>
                        </div>
                        <ul class="filter-content">
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Participants :
                                </div>
                                <div class="filter-content-details">
                                    {{ $totalTheory['counter'] + $totalPractice['counter'] + $totalCME['counter'] }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Theory :
                                </div>
                                <div class="filter-content-details">{{ isset($totalTheory) ? $totalTheory['counter'] : 0 }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Practice :
                                </div>
                                <div class="filter-content-details">
                                    {{ isset($totalPractice) ? $totalPractice['counter'] : 0 }}</div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;CME :
                                </div>
                                <div class="filter-content-details">{{ isset($totalCME) ? $totalCME['counter'] : 0 }}</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <div class="filter-title">
                            <p class="filter-title-text">
                                Financial Statistics
                            </p>
                        </div>
                        <ul class="filter-content">
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Amount :
                                </div>
                                <div class="filter-content-details">
                                    {{ isset($totalAmount) ? number_format($totalAmount['prices'], 0, ',', '.') . '₫' : 0 }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Theoretical Total :
                                </div>
                                <div class="filter-content-details">
                                    {{ isset($totalTheory) ? number_format($totalTheory['prices'], 0, ',', '.') . '₫' : 0 }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total Practice :
                                </div>
                                <div class="filter-content-details">
                                    {{ isset($totalPractice) ? number_format($totalPractice['prices'], 0, ',', '.') . '₫' : 0 }}
                                </div>
                            </li>
                            <li class="filter-content-block">
                                <div class="filter-content-title">
                                    •&nbsp;Total CME :
                                </div>
                                <div class="filter-content-details">
                                    {{ isset($totalCME) ? number_format($totalCME['prices'], 0, ',', '.') . '₫' : 0 }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-agile-info">
        <div class="panel-heading">
            Link tài trợ
        </div>
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <a href="https://docs.google.com/spreadsheets/d/1n2muEE_XiIALFk8iHUY2DaOJrEusA9HzMB6U8GJWyC0/edit?usp=sharing"
                            target="_blank">
                            <div class="filter-title">
                                <p class="filter-title-text">
                                    DS TÀI TRỢ VART 2025
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <a href="https://drive.google.com/drive/folders/1rrRmtHYp28x4rQIbMUwc0QVaWHf9hkFS?usp=sharing"
                            target="_blank">
                            <div class="filter-title">
                                <p class="filter-title-text">
                                    THƯ MỜI TÀI TRỢ
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <a href="https://docs.google.com/spreadsheets/d/1Nn2wxi0DV4cDCQs8MN8LL2wT608AKybhAa3Dve1-eUQ/edit?gid=1458539916#gid=1458539916"
                            target="_blank">
                            <div class="filter-title">
                                <p class="filter-title-text">
                                    BẢNG PHÂN CÔNG HỘI NGHỊ
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="filter-tiles">
                        <a href="https://docs.google.com/spreadsheets/d/1iiQIz6xAwnK1haH7lvEMGeXs03t4cHF4od1--2dyX_g/edit?gid=974923128#gid=974923128"
                            target="_blank">
                            <div class="filter-title">
                                <p class="filter-title-text">
                                    BẢNG PHÂN CÔNG HỘI NGHỊ QUỐC TẾ
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/chart/raphael-min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/chart/morris.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/chart/chart.min.js') }}" defer></script>
@endpush
