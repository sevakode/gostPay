<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Stock Events</h3>
        </div>
    </div>
    <div class="card-body">
        <div id="kt_amcharts_2" style="height: 500px; overflow: visible;">
{{--            <div class="amcharts-stock-div" style="position: relative;">--}}
{{--                <div class="amcharts-center-div">--}}
{{--                    <div class="amcharts-panels-div" style="height: 427px;">--}}
{{--                        --}}
{{--                        <div class="amChartsPanel amcharts-stock-panel-div amcharts-stock-panel-div-stockPanel0" style="height: 427px; width: 100%; overflow: hidden; text-align: left;">--}}
{{--                            <div class="amcharts-main-div" style="position: relative; width: 100%; height: 100%;">--}}
{{--                                <div class="amChartsLegend amcharts-legend-div" style="overflow: hidden; position: relative; text-align: left; width: 853px; height: 24px;">--}}
{{--                                    <svg version="1.1" style="position: absolute; width: 853px; height: 24px;">--}}
{{--                                        <desc>--}}
{{--                                            JavaScript chart by amCharts 3.21.15</desc>--}}
{{--                                        <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" font-weight="bold" text-anchor="start" class="amcharts-legend-title" transform="translate(0,11)">--}}
{{--                                            <tspan y="6" x="0">--}}
{{--                                                Value</tspan>--}}
{{--                                        </text>--}}
{{--                                        <g transform="translate(51,0)">--}}
{{--                                            <path cs="100,100" d="M0.5,0.5 L801.5,0.5 L801.5,23.5 L0.5,23.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-legend-bg">--}}
{{--                                                --}}
{{--                                            </path>--}}
{{--                                            <g transform="translate(0,4)">--}}
{{--                                                <g cursor="pointer" class="amcharts-legend-item-g1" aria-label="" transform="translate(0,0)">--}}
{{--                                                    <g transform="translate(8,8)" visibility="hidden" class="amcharts-legend-switch">--}}
{{--                                                        <path cs="100,100" d="M-5.5,-5.5 L6.5,6.5" fill="none" stroke="#FFFFFF" stroke-width="3">--}}
{{--                                                            --}}
{{--                                                        </path>--}}
{{--                                                        <path cs="100,100" d="M-5.5,6.5 L6.5,-5.5" fill="none"--}}
{{--                                                              stroke="#FFFFFF" stroke-width="3"></path>--}}
{{--                                                    </g>--}}
{{--                                                    <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                          opacity="1" text-anchor="start" class="amcharts-legend-value"--}}
{{--                                                          transform="translate(26,7)"></text>--}}
{{--                                                    <rect x="16" y="0" width="60" height="18" rx="0" ry="0"--}}
{{--                                                          stroke-width="0" stroke="none" fill="#fff"--}}
{{--                                                          fill-opacity="0.005"></rect>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                                <div class="amcharts-chart-div"--}}
{{--                                     style="overflow: hidden; position: relative; text-align: left; width: 853px; height: 403px; padding: 0px;">--}}
{{--                                    <svg version="1.1"--}}
{{--                                         style="position: absolute; width: 853px; height: 403px; top: 0.286926px; left: 0.247162px;">--}}
{{--                                        <desc>JavaScript chart by amCharts 3.21.15</desc>--}}
{{--                                        <g>--}}
{{--                                            <path cs="100,100" d="M0.5,0.5 L852.5,0.5 L852.5,402.5 L0.5,402.5 Z"--}}
{{--                                                  fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1"--}}
{{--                                                  stroke-opacity="0" class="amcharts-bg"></path>--}}
{{--                                            <path cs="100,100"--}}
{{--                                                  d="M0.5,0.5 L852.5,0.5 L852.5,374.5 L0.5,374.5 L0.5,0.5 Z"--}}
{{--                                                  fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1"--}}
{{--                                                  stroke-opacity="0" class="amcharts-plot-area"--}}
{{--                                                  transform="translate(0,0)"></path>--}}
{{--                                        </g>--}}
{{--                                        <g>--}}
{{--                                            <g class="amcharts-category-axis" transform="translate(0,0)">--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M27.5,374.5 L27.5,374.5 L27.5,0.5" fill="none"--}}
{{--                                                          stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                          class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M130.5,374.5 L130.5,374.5 L130.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M233.5,374.5 L233.5,374.5 L233.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M333.5,374.5 L333.5,374.5 L333.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M436.5,374.5 L436.5,374.5 L436.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M539.5,374.5 L539.5,374.5 L539.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M644.5,374.5 L644.5,374.5 L644.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M747.5,374.5 L747.5,374.5 L747.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M850.5,374.5 L850.5,374.5 L850.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                            <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749980"--}}
{{--                                               transform="translate(0,0)" visibility="visible">--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,374.5 L0.5,374.5 L852.5,374.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,321.5 L0.5,321.5 L852.5,321.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,267.5 L0.5,267.5 L852.5,267.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,214.5 L0.5,214.5 L852.5,214.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,160.5 L0.5,160.5 L852.5,160.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,107.5 L0.5,107.5 L852.5,107.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.1"--}}
{{--                                                          stroke="#000000" class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,53.5 L0.5,53.5 L852.5,53.5" fill="none"--}}
{{--                                                          stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                          class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L852.5,0.5" fill="none"--}}
{{--                                                          stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                          class="amcharts-axis-grid"></path>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                        <g transform="translate(0,0)" clip-path="url(#AmChartsEl-14)">--}}
{{--                                            <g visibility="hidden"></g>--}}
{{--                                        </g>--}}
{{--                                        <g></g>--}}
{{--                                        <g></g>--}}
{{--                                        <g></g>--}}
{{--                                        <g>--}}
{{--                                            <g transform="translate(0,0)" class="amcharts-graph-line amcharts-graph-g1">--}}
{{--                                                <g></g>--}}
{{--                                                <g clip-path="url(#AmChartsEl-16)">--}}
{{--                                                    <path cs="100,100"--}}
{{--                                                          d="M6.5,343.24429 L18.5,332.29143 L30.5,333.62714 L41.5,336.03143 L53.5,325.61286 L65.5,325.34571 L77.5,333.62714 L89.5,329.62 L101.5,312.79 L112.5,315.19429 L124.5,308.24857 L136.5,304.24143 L148.5,305.04286 L160.5,291.95286 L172.5,310.11857 L183.5,310.38571 L195.5,304.50857 L207.5,283.67143 L219.5,269.78 L231.5,302.10429 L243.5,275.12286 L254.5,267.64286 L266.5,277.52714 L278.5,265.77286 L290.5,298.09714 L302.5,292.22 L314.5,281.53429 L325.5,239.86 L337.5,234.51714 L349.5,273.52 L361.5,264.97143 L373.5,221.16 L385.5,242.26429 L396.5,242.26429 L408.5,268.97857 L420.5,278.06143 L432.5,220.89286 L444.5,231.04429 L456.5,208.33714 L467.5,217.15286 L479.5,236.12 L491.5,242.53143 L503.5,255.88857 L515.5,189.37 L527.5,203.52857 L538.5,240.92857 L550.5,194.71286 L562.5,248.94286 L574.5,216.61857 L586.5,197.11714 L598.5,161.58714 L609.5,224.09857 L621.5,223.56429 L633.5,215.28286 L645.5,182.15714 L657.5,204.06286 L669.5,183.76 L680.5,171.73857 L692.5,187.23286 L704.5,147.96286 L716.5,195.78143 L728.5,159.71714 L740.5,140.75 L751.5,189.10286 L763.5,169.33429 L775.5,213.14571 L787.5,213.68 L799.5,94 L811.5,135.14 L822.5,80.37571 L834.5,176.28 L846.5,71.29286"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.9"--}}
{{--                                                          stroke="#b0de09" stroke-linejoin="round"--}}
{{--                                                          class="amcharts-graph-stroke"></path>--}}
{{--                                                </g>--}}
{{--                                                <clipPath id="AmChartsEl-16">--}}
{{--                                                    <rect x="0" y="0" width="852" height="374" rx="0" ry="0"--}}
{{--                                                          stroke-width="0"></rect>--}}
{{--                                                </clipPath>--}}
{{--                                                <g></g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                        <g></g>--}}
{{--                                        <g>--}}
{{--                                            <path cs="100,100" d="M0.5,374.5 L852.5,374.5 L852.5,374.5" fill="none"--}}
{{--                                                  stroke-width="1" stroke-opacity="0.2" stroke="#000000"--}}
{{--                                                  transform="translate(0,0)"--}}
{{--                                                  class="amcharts-axis-zero-grid-valueAxisAuto0_1610363749980 amcharts-axis-zero-grid"></path>--}}
{{--                                            <g class="amcharts-category-axis">--}}
{{--                                                <path cs="100,100" d="M0.5,0.5 L852.5,0.5" fill="none" stroke-width="1"--}}
{{--                                                      stroke-opacity="0" stroke="#000000" transform="translate(0,374)"--}}
{{--                                                      class="amcharts-axis-line"></path>--}}
{{--                                            </g>--}}
{{--                                            <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749980">--}}
{{--                                                <path cs="100,100" d="M0.5,0.5 L0.5,374.5" fill="none" stroke-width="1"--}}
{{--                                                      stroke-opacity="0" stroke="#000000" transform="translate(0,0)"--}}
{{--                                                      class="amcharts-axis-line" visibility="visible"></path>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                        <g>--}}
{{--                                            <g transform="translate(0,0)" clip-path="url(#AmChartsEl-15)"--}}
{{--                                               style="pointer-events: none;">--}}
{{--                                                <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L0.5,374.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.5" stroke="#000000"--}}
{{--                                                      class="amcharts-cursor-line amcharts-cursor-line-vertical"--}}
{{--                                                      visibility="hidden"></path>--}}
{{--                                                <path cs="100,100" d="M0.5,0.5 L852.5,0.5 L852.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.5" stroke="#000000"--}}
{{--                                                      class="amcharts-cursor-line amcharts-cursor-line-horizontal"--}}
{{--                                                      visibility="hidden"></path>--}}
{{--                                            </g>--}}
{{--                                            <clipPath id="AmChartsEl-15">--}}
{{--                                                <rect x="0" y="0" width="852" height="374" rx="0" ry="0"--}}
{{--                                                      stroke-width="0"></rect>--}}
{{--                                            </clipPath>--}}
{{--                                        </g>--}}
{{--                                        <g></g>--}}
{{--                                        <g>--}}
{{--                                            <g transform="translate(0,0)" class="amcharts-graph-line amcharts-graph-g1">--}}
{{--                                                <g transform="translate(53,325)" aria-label=" Sep 13, 2010 183"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-7.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <circle r="7.5" cx="0" cy="0" fill="#85CDE6"--}}
{{--                                                                    stroke="#888888" fill-opacity="1" stroke-width="1"--}}
{{--                                                                    stroke-opacity="1"--}}
{{--                                                                    transform="translate(0,-15)"></circle>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-17)">--}}
{{--                                                                <tspan y="6" x="0">S</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(160,291)" aria-label=" Nov 15, 2010 309"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-22.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M0.5,0.5 L12.5,0.5 L12.5,15.5 L0.5,15.5 Z"--}}
{{--                                                                  fill="#FFFFFF" stroke="#888888" fill-opacity="0.5"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  transform="translate(0,-23)"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(6,-17)">--}}
{{--                                                                <tspan y="6" x="0">F</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(195,304)" aria-label=" Dec 06, 2010 262"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,70)">--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M0.5,0.5 L8.5,-3.5 L8.5,-18.5 L-6.5,-18.5 L-6.5,-3.5 L0.5,0.5 Z"--}}
{{--                                                                  fill="#85CDE6" stroke="#888888" fill-opacity="1"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-11)">--}}
{{--                                                                <tspan y="6" x="0">X</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(219,269)" aria-label=" Dec 20, 2010 392"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,105)">--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M0.5,0.5 L8.5,-3.5 L8.5,-18.5 L-6.5,-18.5 L-6.5,-3.5 L0.5,0.5 Z"--}}
{{--                                                                  fill="#85CDE6" stroke="#888888" fill-opacity="1"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-11)">--}}
{{--                                                                <tspan y="6" x="0">Z</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(243,275)" aria-label=" Jan 03, 2011 372"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-7.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <circle r="7.5" cx="0" cy="0" fill="#85CDE6"--}}
{{--                                                                    stroke="#888888" fill-opacity="1" stroke-width="1"--}}
{{--                                                                    stroke-opacity="1"--}}
{{--                                                                    transform="translate(0,-15)"></circle>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-17)">--}}
{{--                                                                <tspan y="6" x="0">U</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(290,298)" aria-label=" Jan 31, 2011 286"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-7.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <circle r="7.5" cx="0" cy="0" fill="#DADADA"--}}
{{--                                                                    stroke="#888888" fill-opacity="1" stroke-width="1"--}}
{{--                                                                    stroke-opacity="1"--}}
{{--                                                                    transform="translate(0,-15)"></circle>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-17)">--}}
{{--                                                                <tspan y="6" x="0">D</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(396,242)" aria-label=" Apr 04, 2011 495"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-7.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <circle r="7.5" cx="0" cy="0" fill="#DADADA"--}}
{{--                                                                    stroke="#888888" fill-opacity="1" stroke-width="1"--}}
{{--                                                                    stroke-opacity="1"--}}
{{--                                                                    transform="translate(0,-15)"></circle>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-17)">--}}
{{--                                                                <tspan y="6" x="0">L</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                        <g transform="translate(0,-23)">--}}
{{--                                                            <path cs="100,100" d="M0.5,0.5 L0.5,-7.5" fill="none"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"--}}
{{--                                                                  stroke="#888888"></path>--}}
{{--                                                            <circle r="7.5" cx="0" cy="0" fill="#DADADA"--}}
{{--                                                                    stroke="#888888" fill-opacity="1" stroke-width="1"--}}
{{--                                                                    stroke-opacity="1"--}}
{{--                                                                    transform="translate(0,-15)"></circle>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-17)">--}}
{{--                                                                <tspan y="6" x="0">R</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(515,189)" aria-label=" Jun 13, 2011 693"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M0.5,0.5 L8.5,8.5 L4.5,8.5 L4.5,16.5 L-3.5,16.5 L-3.5,8.5 L-7.5,8.5 L0.5,0.5 Z"--}}
{{--                                                                  fill="#00CC00" stroke="#888888" fill-opacity="1"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;" visibility="hidden"--}}
{{--                                                                  transform="translate(0,0)">--}}
{{--                                                                <tspan y="6" x="0"></tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(586,197)" aria-label=" Jul 25, 2011 664"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M0.5,0.5 L8.5,-7.5 L4.5,-7.5 L4.5,-15.5 L-3.5,-15.5 L-3.5,-7.5 L-7.5,-7.5 L0.5,0.5 Z"--}}
{{--                                                                  fill="#CC0000" stroke="#888888" fill-opacity="1"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;" visibility="hidden"--}}
{{--                                                                  transform="translate(0,0)">--}}
{{--                                                                <tspan y="6" x="0"></tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                                <g transform="translate(645,182)" aria-label=" Aug 29, 2011 720"--}}
{{--                                                   class="amcharts-graph-bullet">--}}
{{--                                                    <g>--}}
{{--                                                        <g transform="translate(0,0)">--}}
{{--                                                            <path cs="100,100"--}}
{{--                                                                  d="M-51.5,-4.5 L-4.5,-4.5 L0.5,0.5 L5.5,-4.5 L53.5,-4.5 L53.5,-38.5 L-51.5,-38.5 L-51.5,-4.5 Z"--}}
{{--                                                                  fill="#DADADA" stroke="#888888" fill-opacity="1"--}}
{{--                                                                  stroke-width="1" stroke-opacity="1"></path>--}}
{{--                                                            <text y="6" fill="#000000" font-family="Verdana"--}}
{{--                                                                  font-size="11px" opacity="1" text-anchor="middle"--}}
{{--                                                                  style="pointer-events: none;"--}}
{{--                                                                  transform="translate(0,-30)">--}}
{{--                                                                <tspan y="6" x="0">Longer text can</tspan>--}}
{{--                                                                <tspan y="19" x="0">also be displayed</tspan>--}}
{{--                                                            </text>--}}
{{--                                                        </g>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                        <g>--}}
{{--                                            <g></g>--}}
{{--                                        </g>--}}
{{--                                        <g>--}}
{{--                                            <g class="amcharts-category-axis" transform="translate(0,0)"--}}
{{--                                               visibility="visible">--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(30,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Sep</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(133,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Nov</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" font-weight="bold" text-anchor="start"--}}
{{--                                                      transform="translate(236,386.5)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">2011</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(336,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Mar</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(439,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">May</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(542,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Jul</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(647,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Sep</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(750,386.5)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">Nov</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" font-weight="bold" text-anchor="start"--}}
{{--                                                      transform="translate(853,386.5)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">2012</tspan>--}}
{{--                                                </text>--}}
{{--                                            </g>--}}
{{--                                            <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749980"--}}
{{--                                               transform="translate(0,0)" visibility="visible">--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start"--}}
{{--                                                      transform="translate(4,366.171875)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">0</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start"--}}
{{--                                                      transform="translate(4,313.171875)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">200</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start"--}}
{{--                                                      transform="translate(4,259.171875)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">400</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start"--}}
{{--                                                      transform="translate(4,206.171875)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">600</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start"--}}
{{--                                                      transform="translate(4,152.171875)" class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">800</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(4,99.171875)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">1k</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(4,45.171875)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0">1.2k</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#000000" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(4,-1)"--}}
{{--                                                      class="amcharts-axis-label">--}}
{{--                                                    <tspan y="6" x="0"></tspan>--}}
{{--                                                </text>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                        <g></g>--}}
{{--                                        <g transform="translate(0,0)"></g>--}}
{{--                                        <g></g>--}}
{{--                                        <g></g>--}}
{{--                                        <clipPath id="AmChartsEl-14">--}}
{{--                                            <rect x="-1" y="-1" width="854" height="376" rx="0" ry="0"--}}
{{--                                                  stroke-width="0"></rect>--}}
{{--                                        </clipPath>--}}
{{--                                    </svg>--}}
{{--                                    <a href="http://www.amcharts.com" title="JavaScript charts"--}}
{{--                                       style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 729px; top: 5px;">JS--}}
{{--                                        chart by amCharts</a></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="amcharts-scrollbar-chart-div" style="height: 40px; overflow: hidden; text-align: left;">--}}
{{--                        <div class="amcharts-main-div" style="position: relative;">--}}
{{--                            <div class="amcharts-chart-div"--}}
{{--                                 style="overflow: hidden; position: relative; text-align: left; width: 853px; height: 40px; padding: 0px; cursor: default;">--}}
{{--                                <svg version="1.1"--}}
{{--                                     style="position: absolute; width: 853px; height: 40px; top: 0.284058px; left: 0.247162px;">--}}
{{--                                    <desc>JavaScript chart by amCharts 3.21.15</desc>--}}
{{--                                    <g>--}}
{{--                                        <path cs="100,100" d="M0.5,0.5 L852.5,0.5 L852.5,39.5 L0.5,39.5 Z"--}}
{{--                                              fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1"--}}
{{--                                              stroke-opacity="0" class="amcharts-bg"></path>--}}
{{--                                        <path cs="100,100" d="M0.5,0.5 L852.5,0.5 L852.5,0.5 L0.5,0.5 L0.5,0.5 Z"--}}
{{--                                              fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1"--}}
{{--                                              stroke-opacity="0" class="amcharts-plot-area"--}}
{{--                                              transform="translate(0,40)"></path>--}}
{{--                                    </g>--}}
{{--                                    <g>--}}
{{--                                        <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749992"--}}
{{--                                           transform="translate(0,0)" visibility="hidden"></g>--}}
{{--                                        <g class="amcharts-category-axis" transform="translate(0,40)">--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M22.5,0.5 L22.5,0.5 L22.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M126.5,0.5 L126.5,0.5 L126.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M230.5,0.5 L230.5,0.5 L230.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M331.5,0.5 L331.5,0.5 L331.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M435.5,0.5 L435.5,0.5 L435.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M538.5,0.5 L538.5,0.5 L538.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M644.5,0.5 L644.5,0.5 L644.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M748.5,0.5 L748.5,0.5 L748.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                            <g>--}}
{{--                                                <path cs="100,100" d="M852.5,0.5 L852.5,0.5 L852.5,0.5" fill="none"--}}
{{--                                                      stroke-width="1" stroke-opacity="0.1" stroke="#000000"--}}
{{--                                                      class="amcharts-axis-grid"></path>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g>--}}
{{--                                        <path cs="100,100" d="M0.5,40.5 L853.5,40.5 L853.5,40.5" fill="none"--}}
{{--                                              stroke-width="1" stroke-opacity="0" stroke="#000000"--}}
{{--                                              transform="translate(0,0)"--}}
{{--                                              class="amcharts-axis-zero-grid-valueAxisAuto0_1610363749992 amcharts-axis-zero-grid"></path>--}}
{{--                                        <g>--}}
{{--                                            <path cs="100,100" d="M0.5,0.5 L852.5,0.5" fill="none" stroke-width="1"--}}
{{--                                                  stroke-opacity="0" stroke="#000000" transform="translate(0,40)"--}}
{{--                                                  class="amcharts-axis-line"></path>--}}
{{--                                        </g>--}}
{{--                                        <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749992">--}}
{{--                                            <path cs="100,100" d="M0.5,0.5 L0.5,40.5" fill="none" stroke-width="1"--}}
{{--                                                  stroke-opacity="0" stroke="#000000" transform="translate(0,0)"--}}
{{--                                                  class="amcharts-axis-line" visibility="hidden"></path>--}}
{{--                                        </g>--}}
{{--                                        <g class="amcharts-category-axis">--}}
{{--                                            <path cs="100,100" d="M0.5,0.5 L852.5,0.5" fill="none" stroke-width="1"--}}
{{--                                                  stroke-opacity="0" stroke="#000000" transform="translate(0,40)"--}}
{{--                                                  class="amcharts-axis-line"></path>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                    <g></g>--}}
{{--                                    <g>--}}
{{--                                        <g class="amcharts-scrollbar-horizontal" visibility="visible"--}}
{{--                                           transform="translate(0,0)" style="touch-action: none;">--}}
{{--                                            <rect x="0.5" y="0.5" width="853" height="40" rx="0" ry="0" stroke-width="1"--}}
{{--                                                  fill="#000000" stroke="#000000" fill-opacity="0.12"--}}
{{--                                                  stroke-opacity="0.12" class="amcharts-scrollbar-bg"></rect>--}}
{{--                                            <rect x="0.5" y="0.5" width="852" height="41" rx="0" ry="0" stroke-width="0"--}}
{{--                                                  fill="#FFFFFF" stroke="#FFFFFF" fill-opacity="0.4"--}}
{{--                                                  stroke-opacity="0.4" class="amcharts-scrollbar-bg-selected"--}}
{{--                                                  transform="translate(0,0)"></rect>--}}
{{--                                            <g transform="translate(0,0)"--}}
{{--                                               class="amcharts-graph-line amcharts-graph-graphAuto0_1610363749992">--}}
{{--                                                <g></g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100"--}}
{{--                                                          d="M1.5,37.75333 L3.5,37.78 L4.5,37.48667 L6.5,37.38 L8.5,37.3 L9.5,37.43333 L11.5,37.38 L13.5,36.74 L14.5,37.48667 L16.5,37.56667 L18.5,36.28667 L20.5,36.79333 L21.5,36.76667 L23.5,36.52667 L25.5,36.60667 L26.5,36.55333 L28.5,35.94 L30.5,36.42 L32.5,36.04667 L33.5,37.16667 L35.5,36.92667 L37.5,36.07333 L38.5,36.58 L40.5,35.72667 L42.5,36.66 L43.5,36.52667 L45.5,35.80667 L47.5,36.47333 L49.5,37.06 L50.5,36.42 L52.5,36.36667 L54.5,35.62 L55.5,36.82 L57.5,36.68667 L59.5,36.55333 L60.5,36.18 L62.5,36.28667 L64.5,35.64667 L66.5,35.59333 L67.5,36.76667 L69.5,35.40667 L71.5,36.68667 L72.5,34.9 L74.5,34.71333 L76.5,35.03333 L78.5,36.42 L79.5,35.91333 L81.5,35.14 L83.5,34.98 L84.5,34.71333 L86.5,36.28667 L88.5,36.47333 L89.5,36.02 L91.5,34.42 L93.5,35.62 L95.5,35.03333 L96.5,35.03333 L98.5,34.95333 L100.5,36.18 L101.5,34.34 L103.5,35.35333 L105.5,33.99333 L107.5,35.35333 L108.5,34.04667 L110.5,35.7 L112.5,35.22 L113.5,34.58 L115.5,35.56667 L117.5,34.84667 L118.5,34.42 L120.5,35.06 L122.5,34.20667 L124.5,33.78 L125.5,33.88667 L127.5,35.64667 L129.5,35.27333 L130.5,33.67333 L132.5,35.43333 L134.5,35.00667 L136.5,32.9 L137.5,33.48667 L139.5,32.92667 L141.5,33.64667 L142.5,34.15333 L144.5,33.22 L146.5,32.87333 L147.5,33.67333 L149.5,33.56667 L151.5,34.98 L153.5,33.48667 L154.5,33.80667 L156.5,33.72667 L158.5,32.31333 L159.5,32.36667 L161.5,32.260000000000005 L163.5,33.86 L165.5,34.52667 L166.5,31.83333 L168.5,33.67333 L170.5,33.83333 L171.5,34.82 L173.5,34.07333 L175.5,32.9 L176.5,34.47333 L178.5,32.18 L180.5,32.20667 L182.5,34.74 L183.5,31.35333 L185.5,34.1 L187.5,33.22 L188.5,34.87333 L190.5,32.36667 L192.5,32.9 L193.5,34.04667 L195.5,33.22 L197.5,33.51333 L199.5,32.58 L200.5,31.40667 L202.5,34.04667 L204.5,30.66 L205.5,33.99333 L207.5,33.99333 L209.5,31.43333 L211.5,31.24667 L212.5,30.39333 L214.5,33.91333 L216.5,30.55333 L217.5,34.34 L219.5,32.79333 L221.5,30.04667 L222.5,33.00667 L224.5,32.34 L226.5,30.20667 L228.5,34.02 L229.5,29.78 L231.5,30.44667 L233.5,33.27333 L234.5,33.06 L236.5,30.84667 L238.5,32.31333 L239.5,29.7 L241.5,29.75333 L243.5,31.75333 L245.5,30.58 L246.5,30.47333 L248.5,33.27333 L250.5,29.64667 L251.5,29.86 L253.5,29.91333 L255.5,32.60667 L257.5,29.83333 L258.5,33.08667 L260.5,29.35333 L262.5,32.31333 L263.5,30.12667 L265.5,30.79333 L267.5,29.43333 L268.5,30.82 L270.5,32.04667 L272.5,29.11333 L274.5,28.58 L275.5,31.32667 L277.5,33.27333 L279.5,32.98 L280.5,29.64667 L282.5,28.26 L284.5,30.23333 L285.5,28.12667 L287.5,33.14 L289.5,30.23333 L291.5,28.52667 L292.5,32.87333 L294.5,29.03333 L296.5,29.06 L297.5,31.19333 L299.5,28.98 L301.5,29.78 L303.5,30.36667 L304.5,32.28667 L306.5,31.48667 L308.5,31.24667 L309.5,28.52667 L311.5,27.40667 L313.5,29.06 L314.5,27.14 L316.5,31.22 L318.5,30.76667 L320.5,27.22 L321.5,27.24667 L323.5,31.7 L325.5,28.04667 L326.5,32.04667 L328.5,27.06 L330.5,29.91333 L331.5,31.00667 L333.5,31.72667 L335.5,26.66 L337.5,28.26 L338.5,32.52667 L340.5,26.52667 L342.5,28.5 L343.5,27.35333 L345.5,27.54 L347.5,29.67333 L349.5,27.88667 L350.5,31.11333 L352.5,30.42 L354.5,26.95333 L355.5,31.91333 L357.5,26.42 L359.5,31.99333 L360.5,32.18 L362.5,29.40667 L364.5,29.56667 L366.5,27.06 L367.5,31.3 L369.5,30.55333 L371.5,30.9 L372.5,28.74 L374.5,27.11333 L376.5,25.19333 L377.5,26.39333 L379.5,27.08667 L381.5,26.26 L383.5,27.67333 L384.5,26.23333 L386.5,26.44667 L388.5,27.3 L389.5,28.71333 L391.5,28.74 L393.5,27.78 L394.5,30.07333 L396.5,29.96667 L398.5,27.14 L400.5,27.3 L401.5,28.02 L403.5,30.95333 L405.5,29.67333 L406.5,26.31333 L408.5,24.12667 L410.5,29.32667 L412.5,29.96667 L413.5,24.20667 L415.5,29.16667 L417.5,24.18 L418.5,24.84667 L420.5,29.40667 L422.5,23.83333 L423.5,30.87333 L425.5,24.74 L427.5,24.26 L429.5,30.58 L430.5,26.15333 L432.5,30.9 L434.5,27.80667 L435.5,25.16667 L437.5,28.47333 L439.5,29.80667 L440.5,24.87333 L442.5,23.16667 L444.5,28.76667 L446.5,26.34 L447.5,26.18 L449.5,30.12667 L451.5,28.63333 L452.5,22.68667 L454.5,25.78 L456.5,30.39333 L458.5,23.19333 L459.5,23.91333 L461.5,28.04667 L463.5,27.16667 L464.5,28.74 L466.5,26.68667 L468.5,27.88667 L469.5,26.63333 L471.5,24.79333 L473.5,23.91333 L475.5,24.34 L476.5,29.27333 L478.5,24.74 L480.5,30.07333 L481.5,24.39333 L483.5,26.68667 L485.5,25.62 L486.5,25.86 L488.5,26.63333 L490.5,22.55333 L492.5,26.84667 L493.5,22.60667 L495.5,27.32667 L497.5,22.63333 L498.5,24.55333 L500.5,21.59333 L502.5,25.96667 L504.5,27.86 L505.5,25.86 L507.5,28.66 L509.5,24.79333 L510.5,28.39333 L512.5,27.22 L514.5,22.18 L515.5,27.46 L517.5,28.5 L519.5,22.02 L521.5,29.08667 L522.5,28.04667 L524.5,25.43333 L526.5,26.39333 L527.5,24.34 L529.5,25.7 L531.5,23.43333 L533.5,29.46 L534.5,20.47333 L536.5,27.06 L538.5,22.5 L539.5,22.95333 L541.5,28.12667 L543.5,27.16667 L544.5,20.76667 L546.5,23.94 L548.5,21.32667 L550.5,29.19333 L551.5,21.86 L553.5,20.74 L555.5,22.55333 L556.5,28.98 L558.5,20.36667 L560.5,22.92667 L561.5,25.99333 L563.5,24.34 L565.5,25.22 L567.5,27.96667 L568.5,20.02 L570.5,28.52667 L572.5,26.9 L573.5,26.98 L575.5,26.20667 L577.5,20.52667 L579.5,24.74 L580.5,25.62 L582.5,20.87333 L584.5,21.72667 L585.5,20.87333 L587.5,23.35333 L589.5,21.99333 L590.5,22.79333 L592.5,23.14 L594.5,23.22 L596.5,26.44667 L597.5,22.26 L599.5,25.94 L601.5,18.84667 L602.5,19.24667 L604.5,24.74 L606.5,19.35333 L607.5,22.42 L609.5,27.40667 L611.5,27.75333 L613.5,21.80667 L614.5,25.48667 L616.5,19.08667 L618.5,19.80667 L619.5,22.9 L621.5,22.34 L623.5,25.7 L625.5,22.34 L626.5,25.43333 L628.5,19.3 L630.5,23.19333 L631.5,23.86 L633.5,17.16667 L635.5,24.82 L636.5,20.47333 L638.5,24.60667 L640.5,25.22 L642.5,20.76667 L643.5,24.87333 L645.5,17.56667 L647.5,20.36667 L648.5,24.20667 L650.5,21.3 L652.5,21.35333 L653.5,27.06 L655.5,18.58 L657.5,17.00667 L659.5,18.98 L660.5,18.92667 L662.5,23.48667 L664.5,25.08667 L665.5,19.67333 L667.5,18.15333 L669.5,19.14 L671.5,19.94 L672.5,18.60667 L674.5,21.46 L676.5,25.03333 L677.5,23.03333 L679.5,23.78 L681.5,21.38 L682.5,16.92667 L684.5,16.98 L686.5,20.26 L688.5,18.39333 L689.5,15.7 L691.5,16.87333 L693.5,25.62 L694.5,25.27333 L696.5,23.64667 L698.5,21.80667 L699.5,26.42 L701.5,24.74 L703.5,26.47333 L705.5,26.44667 L706.5,21.35333 L708.5,16.92667 L710.5,17.88667 L711.5,25.43333 L713.5,15.27333 L715.5,15.78 L717.5,25.91333 L718.5,22.1 L720.5,16.66 L722.5,22.66 L723.5,20.95333 L725.5,15.88667 L727.5,20.76667 L728.5,21.46 L730.5,23.27333 L732.5,15.38 L734.5,19.06 L735.5,22.36667 L737.5,14.34 L739.5,19.80667 L740.5,20.1 L742.5,24.55333 L744.5,22.98 L746.5,17.16667 L747.5,23.94 L749.5,14.28667 L751.5,13.46 L752.5,16.28667 L754.5,15.59333 L756.5,21.78 L757.5,21.99333 L759.5,15.75333 L761.5,13.67333 L763.5,18.52667 L764.5,19.91333 L766.5,22.9 L768.5,16.206670000000003 L769.5,20.02 L771.5,19.75333 L773.5,21.3 L774.5,12.95333 L776.5,14.63333 L778.5,13.38 L780.5,21.46 L781.5,24.39333 L783.5,13.56667 L785.5,18.9 L786.5,22.71333 L788.5,23.59333 L790.5,18.66 L792.5,25.24667 L793.5,24.44667 L795.5,24.18 L797.5,14.84667 L798.5,21.27333 L800.5,17.16667 L802.5,19.3 L803.5,20.23333 L805.5,12.5 L807.5,18.5 L809.5,11.7 L810.5,22.92667 L812.5,12.71333 L814.5,15.86 L815.5,13.99333 L817.5,16.60667 L819.5,11.54 L820.5,20.31333 L822.5,21.72667 L824.5,22.04667 L826.5,22.74 L827.5,18.23333 L829.5,11.14 L831.5,13.54 L832.5,20.9 L834.5,15.32667 L836.5,17.62 L838.5,21.72667 L839.5,12.87333 L841.5,20.71333 L843.5,16.04667 L844.5,11.19333 L846.5,13.43333 L848.5,23.06 L849.5,17.40667 L851.5,10.23333 L851.5,40.5 L1.5,40.5 L1.5,37.75333 Z"--}}
{{--                                                          fill="#BBBBBB" stroke="#000" fill-opacity="0.5"--}}
{{--                                                          stroke-width="1" stroke-opacity="0"--}}
{{--                                                          class="amcharts-scrollbar-graph-fill"></path>--}}
{{--                                                    <path cs="100,100"--}}
{{--                                                          d="M1.5,37.75333 L3.5,37.78 L4.5,37.48667 L6.5,37.38 L8.5,37.3 L9.5,37.43333 L11.5,37.38 L13.5,36.74 L14.5,37.48667 L16.5,37.56667 L18.5,36.28667 L20.5,36.79333 L21.5,36.76667 L23.5,36.52667 L25.5,36.60667 L26.5,36.55333 L28.5,35.94 L30.5,36.42 L32.5,36.04667 L33.5,37.16667 L35.5,36.92667 L37.5,36.07333 L38.5,36.58 L40.5,35.72667 L42.5,36.66 L43.5,36.52667 L45.5,35.80667 L47.5,36.47333 L49.5,37.06 L50.5,36.42 L52.5,36.36667 L54.5,35.62 L55.5,36.82 L57.5,36.68667 L59.5,36.55333 L60.5,36.18 L62.5,36.28667 L64.5,35.64667 L66.5,35.59333 L67.5,36.76667 L69.5,35.40667 L71.5,36.68667 L72.5,34.9 L74.5,34.71333 L76.5,35.03333 L78.5,36.42 L79.5,35.91333 L81.5,35.14 L83.5,34.98 L84.5,34.71333 L86.5,36.28667 L88.5,36.47333 L89.5,36.02 L91.5,34.42 L93.5,35.62 L95.5,35.03333 L96.5,35.03333 L98.5,34.95333 L100.5,36.18 L101.5,34.34 L103.5,35.35333 L105.5,33.99333 L107.5,35.35333 L108.5,34.04667 L110.5,35.7 L112.5,35.22 L113.5,34.58 L115.5,35.56667 L117.5,34.84667 L118.5,34.42 L120.5,35.06 L122.5,34.20667 L124.5,33.78 L125.5,33.88667 L127.5,35.64667 L129.5,35.27333 L130.5,33.67333 L132.5,35.43333 L134.5,35.00667 L136.5,32.9 L137.5,33.48667 L139.5,32.92667 L141.5,33.64667 L142.5,34.15333 L144.5,33.22 L146.5,32.87333 L147.5,33.67333 L149.5,33.56667 L151.5,34.98 L153.5,33.48667 L154.5,33.80667 L156.5,33.72667 L158.5,32.31333 L159.5,32.36667 L161.5,32.260000000000005 L163.5,33.86 L165.5,34.52667 L166.5,31.83333 L168.5,33.67333 L170.5,33.83333 L171.5,34.82 L173.5,34.07333 L175.5,32.9 L176.5,34.47333 L178.5,32.18 L180.5,32.20667 L182.5,34.74 L183.5,31.35333 L185.5,34.1 L187.5,33.22 L188.5,34.87333 L190.5,32.36667 L192.5,32.9 L193.5,34.04667 L195.5,33.22 L197.5,33.51333 L199.5,32.58 L200.5,31.40667 L202.5,34.04667 L204.5,30.66 L205.5,33.99333 L207.5,33.99333 L209.5,31.43333 L211.5,31.24667 L212.5,30.39333 L214.5,33.91333 L216.5,30.55333 L217.5,34.34 L219.5,32.79333 L221.5,30.04667 L222.5,33.00667 L224.5,32.34 L226.5,30.20667 L228.5,34.02 L229.5,29.78 L231.5,30.44667 L233.5,33.27333 L234.5,33.06 L236.5,30.84667 L238.5,32.31333 L239.5,29.7 L241.5,29.75333 L243.5,31.75333 L245.5,30.58 L246.5,30.47333 L248.5,33.27333 L250.5,29.64667 L251.5,29.86 L253.5,29.91333 L255.5,32.60667 L257.5,29.83333 L258.5,33.08667 L260.5,29.35333 L262.5,32.31333 L263.5,30.12667 L265.5,30.79333 L267.5,29.43333 L268.5,30.82 L270.5,32.04667 L272.5,29.11333 L274.5,28.58 L275.5,31.32667 L277.5,33.27333 L279.5,32.98 L280.5,29.64667 L282.5,28.26 L284.5,30.23333 L285.5,28.12667 L287.5,33.14 L289.5,30.23333 L291.5,28.52667 L292.5,32.87333 L294.5,29.03333 L296.5,29.06 L297.5,31.19333 L299.5,28.98 L301.5,29.78 L303.5,30.36667 L304.5,32.28667 L306.5,31.48667 L308.5,31.24667 L309.5,28.52667 L311.5,27.40667 L313.5,29.06 L314.5,27.14 L316.5,31.22 L318.5,30.76667 L320.5,27.22 L321.5,27.24667 L323.5,31.7 L325.5,28.04667 L326.5,32.04667 L328.5,27.06 L330.5,29.91333 L331.5,31.00667 L333.5,31.72667 L335.5,26.66 L337.5,28.26 L338.5,32.52667 L340.5,26.52667 L342.5,28.5 L343.5,27.35333 L345.5,27.54 L347.5,29.67333 L349.5,27.88667 L350.5,31.11333 L352.5,30.42 L354.5,26.95333 L355.5,31.91333 L357.5,26.42 L359.5,31.99333 L360.5,32.18 L362.5,29.40667 L364.5,29.56667 L366.5,27.06 L367.5,31.3 L369.5,30.55333 L371.5,30.9 L372.5,28.74 L374.5,27.11333 L376.5,25.19333 L377.5,26.39333 L379.5,27.08667 L381.5,26.26 L383.5,27.67333 L384.5,26.23333 L386.5,26.44667 L388.5,27.3 L389.5,28.71333 L391.5,28.74 L393.5,27.78 L394.5,30.07333 L396.5,29.96667 L398.5,27.14 L400.5,27.3 L401.5,28.02 L403.5,30.95333 L405.5,29.67333 L406.5,26.31333 L408.5,24.12667 L410.5,29.32667 L412.5,29.96667 L413.5,24.20667 L415.5,29.16667 L417.5,24.18 L418.5,24.84667 L420.5,29.40667 L422.5,23.83333 L423.5,30.87333 L425.5,24.74 L427.5,24.26 L429.5,30.58 L430.5,26.15333 L432.5,30.9 L434.5,27.80667 L435.5,25.16667 L437.5,28.47333 L439.5,29.80667 L440.5,24.87333 L442.5,23.16667 L444.5,28.76667 L446.5,26.34 L447.5,26.18 L449.5,30.12667 L451.5,28.63333 L452.5,22.68667 L454.5,25.78 L456.5,30.39333 L458.5,23.19333 L459.5,23.91333 L461.5,28.04667 L463.5,27.16667 L464.5,28.74 L466.5,26.68667 L468.5,27.88667 L469.5,26.63333 L471.5,24.79333 L473.5,23.91333 L475.5,24.34 L476.5,29.27333 L478.5,24.74 L480.5,30.07333 L481.5,24.39333 L483.5,26.68667 L485.5,25.62 L486.5,25.86 L488.5,26.63333 L490.5,22.55333 L492.5,26.84667 L493.5,22.60667 L495.5,27.32667 L497.5,22.63333 L498.5,24.55333 L500.5,21.59333 L502.5,25.96667 L504.5,27.86 L505.5,25.86 L507.5,28.66 L509.5,24.79333 L510.5,28.39333 L512.5,27.22 L514.5,22.18 L515.5,27.46 L517.5,28.5 L519.5,22.02 L521.5,29.08667 L522.5,28.04667 L524.5,25.43333 L526.5,26.39333 L527.5,24.34 L529.5,25.7 L531.5,23.43333 L533.5,29.46 L534.5,20.47333 L536.5,27.06 L538.5,22.5 L539.5,22.95333 L541.5,28.12667 L543.5,27.16667 L544.5,20.76667 L546.5,23.94 L548.5,21.32667 L550.5,29.19333 L551.5,21.86 L553.5,20.74 L555.5,22.55333 L556.5,28.98 L558.5,20.36667 L560.5,22.92667 L561.5,25.99333 L563.5,24.34 L565.5,25.22 L567.5,27.96667 L568.5,20.02 L570.5,28.52667 L572.5,26.9 L573.5,26.98 L575.5,26.20667 L577.5,20.52667 L579.5,24.74 L580.5,25.62 L582.5,20.87333 L584.5,21.72667 L585.5,20.87333 L587.5,23.35333 L589.5,21.99333 L590.5,22.79333 L592.5,23.14 L594.5,23.22 L596.5,26.44667 L597.5,22.26 L599.5,25.94 L601.5,18.84667 L602.5,19.24667 L604.5,24.74 L606.5,19.35333 L607.5,22.42 L609.5,27.40667 L611.5,27.75333 L613.5,21.80667 L614.5,25.48667 L616.5,19.08667 L618.5,19.80667 L619.5,22.9 L621.5,22.34 L623.5,25.7 L625.5,22.34 L626.5,25.43333 L628.5,19.3 L630.5,23.19333 L631.5,23.86 L633.5,17.16667 L635.5,24.82 L636.5,20.47333 L638.5,24.60667 L640.5,25.22 L642.5,20.76667 L643.5,24.87333 L645.5,17.56667 L647.5,20.36667 L648.5,24.20667 L650.5,21.3 L652.5,21.35333 L653.5,27.06 L655.5,18.58 L657.5,17.00667 L659.5,18.98 L660.5,18.92667 L662.5,23.48667 L664.5,25.08667 L665.5,19.67333 L667.5,18.15333 L669.5,19.14 L671.5,19.94 L672.5,18.60667 L674.5,21.46 L676.5,25.03333 L677.5,23.03333 L679.5,23.78 L681.5,21.38 L682.5,16.92667 L684.5,16.98 L686.5,20.26 L688.5,18.39333 L689.5,15.7 L691.5,16.87333 L693.5,25.62 L694.5,25.27333 L696.5,23.64667 L698.5,21.80667 L699.5,26.42 L701.5,24.74 L703.5,26.47333 L705.5,26.44667 L706.5,21.35333 L708.5,16.92667 L710.5,17.88667 L711.5,25.43333 L713.5,15.27333 L715.5,15.78 L717.5,25.91333 L718.5,22.1 L720.5,16.66 L722.5,22.66 L723.5,20.95333 L725.5,15.88667 L727.5,20.76667 L728.5,21.46 L730.5,23.27333 L732.5,15.38 L734.5,19.06 L735.5,22.36667 L737.5,14.34 L739.5,19.80667 L740.5,20.1 L742.5,24.55333 L744.5,22.98 L746.5,17.16667 L747.5,23.94 L749.5,14.28667 L751.5,13.46 L752.5,16.28667 L754.5,15.59333 L756.5,21.78 L757.5,21.99333 L759.5,15.75333 L761.5,13.67333 L763.5,18.52667 L764.5,19.91333 L766.5,22.9 L768.5,16.206670000000003 L769.5,20.02 L771.5,19.75333 L773.5,21.3 L774.5,12.95333 L776.5,14.63333 L778.5,13.38 L780.5,21.46 L781.5,24.39333 L783.5,13.56667 L785.5,18.9 L786.5,22.71333 L788.5,23.59333 L790.5,18.66 L792.5,25.24667 L793.5,24.44667 L795.5,24.18 L797.5,14.84667 L798.5,21.27333 L800.5,17.16667 L802.5,19.3 L803.5,20.23333 L805.5,12.5 L807.5,18.5 L809.5,11.7 L810.5,22.92667 L812.5,12.71333 L814.5,15.86 L815.5,13.99333 L817.5,16.60667 L819.5,11.54 L820.5,20.31333 L822.5,21.72667 L824.5,22.04667 L826.5,22.74 L827.5,18.23333 L829.5,11.14 L831.5,13.54 L832.5,20.9 L834.5,15.32667 L836.5,17.62 L838.5,21.72667 L839.5,12.87333 L841.5,20.71333 L843.5,16.04667 L844.5,11.19333 L846.5,13.43333 L848.5,23.06 L849.5,17.40667 L851.5,10.23333"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0"--}}
{{--                                                          stroke="#BBBBBB" stroke-linejoin="round"--}}
{{--                                                          class="amcharts-scrollbar-graph-stroke"></path>--}}
{{--                                                </g>--}}
{{--                                                <g></g>--}}
{{--                                            </g>--}}
{{--                                            <g transform="translate(0,0)"--}}
{{--                                               class="amcharts-graph-line amcharts-graph-graphAuto0_1610363749992"--}}
{{--                                               clip-path="url(#AmChartsEl-13)">--}}
{{--                                                <g></g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100"--}}
{{--                                                          d="M1.5,37.75333 L3.5,37.78 L4.5,37.48667 L6.5,37.38 L8.5,37.3 L9.5,37.43333 L11.5,37.38 L13.5,36.74 L14.5,37.48667 L16.5,37.56667 L18.5,36.28667 L20.5,36.79333 L21.5,36.76667 L23.5,36.52667 L25.5,36.60667 L26.5,36.55333 L28.5,35.94 L30.5,36.42 L32.5,36.04667 L33.5,37.16667 L35.5,36.92667 L37.5,36.07333 L38.5,36.58 L40.5,35.72667 L42.5,36.66 L43.5,36.52667 L45.5,35.80667 L47.5,36.47333 L49.5,37.06 L50.5,36.42 L52.5,36.36667 L54.5,35.62 L55.5,36.82 L57.5,36.68667 L59.5,36.55333 L60.5,36.18 L62.5,36.28667 L64.5,35.64667 L66.5,35.59333 L67.5,36.76667 L69.5,35.40667 L71.5,36.68667 L72.5,34.9 L74.5,34.71333 L76.5,35.03333 L78.5,36.42 L79.5,35.91333 L81.5,35.14 L83.5,34.98 L84.5,34.71333 L86.5,36.28667 L88.5,36.47333 L89.5,36.02 L91.5,34.42 L93.5,35.62 L95.5,35.03333 L96.5,35.03333 L98.5,34.95333 L100.5,36.18 L101.5,34.34 L103.5,35.35333 L105.5,33.99333 L107.5,35.35333 L108.5,34.04667 L110.5,35.7 L112.5,35.22 L113.5,34.58 L115.5,35.56667 L117.5,34.84667 L118.5,34.42 L120.5,35.06 L122.5,34.20667 L124.5,33.78 L125.5,33.88667 L127.5,35.64667 L129.5,35.27333 L130.5,33.67333 L132.5,35.43333 L134.5,35.00667 L136.5,32.9 L137.5,33.48667 L139.5,32.92667 L141.5,33.64667 L142.5,34.15333 L144.5,33.22 L146.5,32.87333 L147.5,33.67333 L149.5,33.56667 L151.5,34.98 L153.5,33.48667 L154.5,33.80667 L156.5,33.72667 L158.5,32.31333 L159.5,32.36667 L161.5,32.260000000000005 L163.5,33.86 L165.5,34.52667 L166.5,31.83333 L168.5,33.67333 L170.5,33.83333 L171.5,34.82 L173.5,34.07333 L175.5,32.9 L176.5,34.47333 L178.5,32.18 L180.5,32.20667 L182.5,34.74 L183.5,31.35333 L185.5,34.1 L187.5,33.22 L188.5,34.87333 L190.5,32.36667 L192.5,32.9 L193.5,34.04667 L195.5,33.22 L197.5,33.51333 L199.5,32.58 L200.5,31.40667 L202.5,34.04667 L204.5,30.66 L205.5,33.99333 L207.5,33.99333 L209.5,31.43333 L211.5,31.24667 L212.5,30.39333 L214.5,33.91333 L216.5,30.55333 L217.5,34.34 L219.5,32.79333 L221.5,30.04667 L222.5,33.00667 L224.5,32.34 L226.5,30.20667 L228.5,34.02 L229.5,29.78 L231.5,30.44667 L233.5,33.27333 L234.5,33.06 L236.5,30.84667 L238.5,32.31333 L239.5,29.7 L241.5,29.75333 L243.5,31.75333 L245.5,30.58 L246.5,30.47333 L248.5,33.27333 L250.5,29.64667 L251.5,29.86 L253.5,29.91333 L255.5,32.60667 L257.5,29.83333 L258.5,33.08667 L260.5,29.35333 L262.5,32.31333 L263.5,30.12667 L265.5,30.79333 L267.5,29.43333 L268.5,30.82 L270.5,32.04667 L272.5,29.11333 L274.5,28.58 L275.5,31.32667 L277.5,33.27333 L279.5,32.98 L280.5,29.64667 L282.5,28.26 L284.5,30.23333 L285.5,28.12667 L287.5,33.14 L289.5,30.23333 L291.5,28.52667 L292.5,32.87333 L294.5,29.03333 L296.5,29.06 L297.5,31.19333 L299.5,28.98 L301.5,29.78 L303.5,30.36667 L304.5,32.28667 L306.5,31.48667 L308.5,31.24667 L309.5,28.52667 L311.5,27.40667 L313.5,29.06 L314.5,27.14 L316.5,31.22 L318.5,30.76667 L320.5,27.22 L321.5,27.24667 L323.5,31.7 L325.5,28.04667 L326.5,32.04667 L328.5,27.06 L330.5,29.91333 L331.5,31.00667 L333.5,31.72667 L335.5,26.66 L337.5,28.26 L338.5,32.52667 L340.5,26.52667 L342.5,28.5 L343.5,27.35333 L345.5,27.54 L347.5,29.67333 L349.5,27.88667 L350.5,31.11333 L352.5,30.42 L354.5,26.95333 L355.5,31.91333 L357.5,26.42 L359.5,31.99333 L360.5,32.18 L362.5,29.40667 L364.5,29.56667 L366.5,27.06 L367.5,31.3 L369.5,30.55333 L371.5,30.9 L372.5,28.74 L374.5,27.11333 L376.5,25.19333 L377.5,26.39333 L379.5,27.08667 L381.5,26.26 L383.5,27.67333 L384.5,26.23333 L386.5,26.44667 L388.5,27.3 L389.5,28.71333 L391.5,28.74 L393.5,27.78 L394.5,30.07333 L396.5,29.96667 L398.5,27.14 L400.5,27.3 L401.5,28.02 L403.5,30.95333 L405.5,29.67333 L406.5,26.31333 L408.5,24.12667 L410.5,29.32667 L412.5,29.96667 L413.5,24.20667 L415.5,29.16667 L417.5,24.18 L418.5,24.84667 L420.5,29.40667 L422.5,23.83333 L423.5,30.87333 L425.5,24.74 L427.5,24.26 L429.5,30.58 L430.5,26.15333 L432.5,30.9 L434.5,27.80667 L435.5,25.16667 L437.5,28.47333 L439.5,29.80667 L440.5,24.87333 L442.5,23.16667 L444.5,28.76667 L446.5,26.34 L447.5,26.18 L449.5,30.12667 L451.5,28.63333 L452.5,22.68667 L454.5,25.78 L456.5,30.39333 L458.5,23.19333 L459.5,23.91333 L461.5,28.04667 L463.5,27.16667 L464.5,28.74 L466.5,26.68667 L468.5,27.88667 L469.5,26.63333 L471.5,24.79333 L473.5,23.91333 L475.5,24.34 L476.5,29.27333 L478.5,24.74 L480.5,30.07333 L481.5,24.39333 L483.5,26.68667 L485.5,25.62 L486.5,25.86 L488.5,26.63333 L490.5,22.55333 L492.5,26.84667 L493.5,22.60667 L495.5,27.32667 L497.5,22.63333 L498.5,24.55333 L500.5,21.59333 L502.5,25.96667 L504.5,27.86 L505.5,25.86 L507.5,28.66 L509.5,24.79333 L510.5,28.39333 L512.5,27.22 L514.5,22.18 L515.5,27.46 L517.5,28.5 L519.5,22.02 L521.5,29.08667 L522.5,28.04667 L524.5,25.43333 L526.5,26.39333 L527.5,24.34 L529.5,25.7 L531.5,23.43333 L533.5,29.46 L534.5,20.47333 L536.5,27.06 L538.5,22.5 L539.5,22.95333 L541.5,28.12667 L543.5,27.16667 L544.5,20.76667 L546.5,23.94 L548.5,21.32667 L550.5,29.19333 L551.5,21.86 L553.5,20.74 L555.5,22.55333 L556.5,28.98 L558.5,20.36667 L560.5,22.92667 L561.5,25.99333 L563.5,24.34 L565.5,25.22 L567.5,27.96667 L568.5,20.02 L570.5,28.52667 L572.5,26.9 L573.5,26.98 L575.5,26.20667 L577.5,20.52667 L579.5,24.74 L580.5,25.62 L582.5,20.87333 L584.5,21.72667 L585.5,20.87333 L587.5,23.35333 L589.5,21.99333 L590.5,22.79333 L592.5,23.14 L594.5,23.22 L596.5,26.44667 L597.5,22.26 L599.5,25.94 L601.5,18.84667 L602.5,19.24667 L604.5,24.74 L606.5,19.35333 L607.5,22.42 L609.5,27.40667 L611.5,27.75333 L613.5,21.80667 L614.5,25.48667 L616.5,19.08667 L618.5,19.80667 L619.5,22.9 L621.5,22.34 L623.5,25.7 L625.5,22.34 L626.5,25.43333 L628.5,19.3 L630.5,23.19333 L631.5,23.86 L633.5,17.16667 L635.5,24.82 L636.5,20.47333 L638.5,24.60667 L640.5,25.22 L642.5,20.76667 L643.5,24.87333 L645.5,17.56667 L647.5,20.36667 L648.5,24.20667 L650.5,21.3 L652.5,21.35333 L653.5,27.06 L655.5,18.58 L657.5,17.00667 L659.5,18.98 L660.5,18.92667 L662.5,23.48667 L664.5,25.08667 L665.5,19.67333 L667.5,18.15333 L669.5,19.14 L671.5,19.94 L672.5,18.60667 L674.5,21.46 L676.5,25.03333 L677.5,23.03333 L679.5,23.78 L681.5,21.38 L682.5,16.92667 L684.5,16.98 L686.5,20.26 L688.5,18.39333 L689.5,15.7 L691.5,16.87333 L693.5,25.62 L694.5,25.27333 L696.5,23.64667 L698.5,21.80667 L699.5,26.42 L701.5,24.74 L703.5,26.47333 L705.5,26.44667 L706.5,21.35333 L708.5,16.92667 L710.5,17.88667 L711.5,25.43333 L713.5,15.27333 L715.5,15.78 L717.5,25.91333 L718.5,22.1 L720.5,16.66 L722.5,22.66 L723.5,20.95333 L725.5,15.88667 L727.5,20.76667 L728.5,21.46 L730.5,23.27333 L732.5,15.38 L734.5,19.06 L735.5,22.36667 L737.5,14.34 L739.5,19.80667 L740.5,20.1 L742.5,24.55333 L744.5,22.98 L746.5,17.16667 L747.5,23.94 L749.5,14.28667 L751.5,13.46 L752.5,16.28667 L754.5,15.59333 L756.5,21.78 L757.5,21.99333 L759.5,15.75333 L761.5,13.67333 L763.5,18.52667 L764.5,19.91333 L766.5,22.9 L768.5,16.206670000000003 L769.5,20.02 L771.5,19.75333 L773.5,21.3 L774.5,12.95333 L776.5,14.63333 L778.5,13.38 L780.5,21.46 L781.5,24.39333 L783.5,13.56667 L785.5,18.9 L786.5,22.71333 L788.5,23.59333 L790.5,18.66 L792.5,25.24667 L793.5,24.44667 L795.5,24.18 L797.5,14.84667 L798.5,21.27333 L800.5,17.16667 L802.5,19.3 L803.5,20.23333 L805.5,12.5 L807.5,18.5 L809.5,11.7 L810.5,22.92667 L812.5,12.71333 L814.5,15.86 L815.5,13.99333 L817.5,16.60667 L819.5,11.54 L820.5,20.31333 L822.5,21.72667 L824.5,22.04667 L826.5,22.74 L827.5,18.23333 L829.5,11.14 L831.5,13.54 L832.5,20.9 L834.5,15.32667 L836.5,17.62 L838.5,21.72667 L839.5,12.87333 L841.5,20.71333 L843.5,16.04667 L844.5,11.19333 L846.5,13.43333 L848.5,23.06 L849.5,17.40667 L851.5,10.23333 L851.5,40.5 L1.5,40.5 L1.5,37.75333 Z"--}}
{{--                                                          fill="#888888" stroke="#000" fill-opacity="1" stroke-width="1"--}}
{{--                                                          stroke-opacity="0"--}}
{{--                                                          class="amcharts-scrollbar-graph-selected-fill"></path>--}}
{{--                                                    <path cs="100,100"--}}
{{--                                                          d="M1.5,37.75333 L3.5,37.78 L4.5,37.48667 L6.5,37.38 L8.5,37.3 L9.5,37.43333 L11.5,37.38 L13.5,36.74 L14.5,37.48667 L16.5,37.56667 L18.5,36.28667 L20.5,36.79333 L21.5,36.76667 L23.5,36.52667 L25.5,36.60667 L26.5,36.55333 L28.5,35.94 L30.5,36.42 L32.5,36.04667 L33.5,37.16667 L35.5,36.92667 L37.5,36.07333 L38.5,36.58 L40.5,35.72667 L42.5,36.66 L43.5,36.52667 L45.5,35.80667 L47.5,36.47333 L49.5,37.06 L50.5,36.42 L52.5,36.36667 L54.5,35.62 L55.5,36.82 L57.5,36.68667 L59.5,36.55333 L60.5,36.18 L62.5,36.28667 L64.5,35.64667 L66.5,35.59333 L67.5,36.76667 L69.5,35.40667 L71.5,36.68667 L72.5,34.9 L74.5,34.71333 L76.5,35.03333 L78.5,36.42 L79.5,35.91333 L81.5,35.14 L83.5,34.98 L84.5,34.71333 L86.5,36.28667 L88.5,36.47333 L89.5,36.02 L91.5,34.42 L93.5,35.62 L95.5,35.03333 L96.5,35.03333 L98.5,34.95333 L100.5,36.18 L101.5,34.34 L103.5,35.35333 L105.5,33.99333 L107.5,35.35333 L108.5,34.04667 L110.5,35.7 L112.5,35.22 L113.5,34.58 L115.5,35.56667 L117.5,34.84667 L118.5,34.42 L120.5,35.06 L122.5,34.20667 L124.5,33.78 L125.5,33.88667 L127.5,35.64667 L129.5,35.27333 L130.5,33.67333 L132.5,35.43333 L134.5,35.00667 L136.5,32.9 L137.5,33.48667 L139.5,32.92667 L141.5,33.64667 L142.5,34.15333 L144.5,33.22 L146.5,32.87333 L147.5,33.67333 L149.5,33.56667 L151.5,34.98 L153.5,33.48667 L154.5,33.80667 L156.5,33.72667 L158.5,32.31333 L159.5,32.36667 L161.5,32.260000000000005 L163.5,33.86 L165.5,34.52667 L166.5,31.83333 L168.5,33.67333 L170.5,33.83333 L171.5,34.82 L173.5,34.07333 L175.5,32.9 L176.5,34.47333 L178.5,32.18 L180.5,32.20667 L182.5,34.74 L183.5,31.35333 L185.5,34.1 L187.5,33.22 L188.5,34.87333 L190.5,32.36667 L192.5,32.9 L193.5,34.04667 L195.5,33.22 L197.5,33.51333 L199.5,32.58 L200.5,31.40667 L202.5,34.04667 L204.5,30.66 L205.5,33.99333 L207.5,33.99333 L209.5,31.43333 L211.5,31.24667 L212.5,30.39333 L214.5,33.91333 L216.5,30.55333 L217.5,34.34 L219.5,32.79333 L221.5,30.04667 L222.5,33.00667 L224.5,32.34 L226.5,30.20667 L228.5,34.02 L229.5,29.78 L231.5,30.44667 L233.5,33.27333 L234.5,33.06 L236.5,30.84667 L238.5,32.31333 L239.5,29.7 L241.5,29.75333 L243.5,31.75333 L245.5,30.58 L246.5,30.47333 L248.5,33.27333 L250.5,29.64667 L251.5,29.86 L253.5,29.91333 L255.5,32.60667 L257.5,29.83333 L258.5,33.08667 L260.5,29.35333 L262.5,32.31333 L263.5,30.12667 L265.5,30.79333 L267.5,29.43333 L268.5,30.82 L270.5,32.04667 L272.5,29.11333 L274.5,28.58 L275.5,31.32667 L277.5,33.27333 L279.5,32.98 L280.5,29.64667 L282.5,28.26 L284.5,30.23333 L285.5,28.12667 L287.5,33.14 L289.5,30.23333 L291.5,28.52667 L292.5,32.87333 L294.5,29.03333 L296.5,29.06 L297.5,31.19333 L299.5,28.98 L301.5,29.78 L303.5,30.36667 L304.5,32.28667 L306.5,31.48667 L308.5,31.24667 L309.5,28.52667 L311.5,27.40667 L313.5,29.06 L314.5,27.14 L316.5,31.22 L318.5,30.76667 L320.5,27.22 L321.5,27.24667 L323.5,31.7 L325.5,28.04667 L326.5,32.04667 L328.5,27.06 L330.5,29.91333 L331.5,31.00667 L333.5,31.72667 L335.5,26.66 L337.5,28.26 L338.5,32.52667 L340.5,26.52667 L342.5,28.5 L343.5,27.35333 L345.5,27.54 L347.5,29.67333 L349.5,27.88667 L350.5,31.11333 L352.5,30.42 L354.5,26.95333 L355.5,31.91333 L357.5,26.42 L359.5,31.99333 L360.5,32.18 L362.5,29.40667 L364.5,29.56667 L366.5,27.06 L367.5,31.3 L369.5,30.55333 L371.5,30.9 L372.5,28.74 L374.5,27.11333 L376.5,25.19333 L377.5,26.39333 L379.5,27.08667 L381.5,26.26 L383.5,27.67333 L384.5,26.23333 L386.5,26.44667 L388.5,27.3 L389.5,28.71333 L391.5,28.74 L393.5,27.78 L394.5,30.07333 L396.5,29.96667 L398.5,27.14 L400.5,27.3 L401.5,28.02 L403.5,30.95333 L405.5,29.67333 L406.5,26.31333 L408.5,24.12667 L410.5,29.32667 L412.5,29.96667 L413.5,24.20667 L415.5,29.16667 L417.5,24.18 L418.5,24.84667 L420.5,29.40667 L422.5,23.83333 L423.5,30.87333 L425.5,24.74 L427.5,24.26 L429.5,30.58 L430.5,26.15333 L432.5,30.9 L434.5,27.80667 L435.5,25.16667 L437.5,28.47333 L439.5,29.80667 L440.5,24.87333 L442.5,23.16667 L444.5,28.76667 L446.5,26.34 L447.5,26.18 L449.5,30.12667 L451.5,28.63333 L452.5,22.68667 L454.5,25.78 L456.5,30.39333 L458.5,23.19333 L459.5,23.91333 L461.5,28.04667 L463.5,27.16667 L464.5,28.74 L466.5,26.68667 L468.5,27.88667 L469.5,26.63333 L471.5,24.79333 L473.5,23.91333 L475.5,24.34 L476.5,29.27333 L478.5,24.74 L480.5,30.07333 L481.5,24.39333 L483.5,26.68667 L485.5,25.62 L486.5,25.86 L488.5,26.63333 L490.5,22.55333 L492.5,26.84667 L493.5,22.60667 L495.5,27.32667 L497.5,22.63333 L498.5,24.55333 L500.5,21.59333 L502.5,25.96667 L504.5,27.86 L505.5,25.86 L507.5,28.66 L509.5,24.79333 L510.5,28.39333 L512.5,27.22 L514.5,22.18 L515.5,27.46 L517.5,28.5 L519.5,22.02 L521.5,29.08667 L522.5,28.04667 L524.5,25.43333 L526.5,26.39333 L527.5,24.34 L529.5,25.7 L531.5,23.43333 L533.5,29.46 L534.5,20.47333 L536.5,27.06 L538.5,22.5 L539.5,22.95333 L541.5,28.12667 L543.5,27.16667 L544.5,20.76667 L546.5,23.94 L548.5,21.32667 L550.5,29.19333 L551.5,21.86 L553.5,20.74 L555.5,22.55333 L556.5,28.98 L558.5,20.36667 L560.5,22.92667 L561.5,25.99333 L563.5,24.34 L565.5,25.22 L567.5,27.96667 L568.5,20.02 L570.5,28.52667 L572.5,26.9 L573.5,26.98 L575.5,26.20667 L577.5,20.52667 L579.5,24.74 L580.5,25.62 L582.5,20.87333 L584.5,21.72667 L585.5,20.87333 L587.5,23.35333 L589.5,21.99333 L590.5,22.79333 L592.5,23.14 L594.5,23.22 L596.5,26.44667 L597.5,22.26 L599.5,25.94 L601.5,18.84667 L602.5,19.24667 L604.5,24.74 L606.5,19.35333 L607.5,22.42 L609.5,27.40667 L611.5,27.75333 L613.5,21.80667 L614.5,25.48667 L616.5,19.08667 L618.5,19.80667 L619.5,22.9 L621.5,22.34 L623.5,25.7 L625.5,22.34 L626.5,25.43333 L628.5,19.3 L630.5,23.19333 L631.5,23.86 L633.5,17.16667 L635.5,24.82 L636.5,20.47333 L638.5,24.60667 L640.5,25.22 L642.5,20.76667 L643.5,24.87333 L645.5,17.56667 L647.5,20.36667 L648.5,24.20667 L650.5,21.3 L652.5,21.35333 L653.5,27.06 L655.5,18.58 L657.5,17.00667 L659.5,18.98 L660.5,18.92667 L662.5,23.48667 L664.5,25.08667 L665.5,19.67333 L667.5,18.15333 L669.5,19.14 L671.5,19.94 L672.5,18.60667 L674.5,21.46 L676.5,25.03333 L677.5,23.03333 L679.5,23.78 L681.5,21.38 L682.5,16.92667 L684.5,16.98 L686.5,20.26 L688.5,18.39333 L689.5,15.7 L691.5,16.87333 L693.5,25.62 L694.5,25.27333 L696.5,23.64667 L698.5,21.80667 L699.5,26.42 L701.5,24.74 L703.5,26.47333 L705.5,26.44667 L706.5,21.35333 L708.5,16.92667 L710.5,17.88667 L711.5,25.43333 L713.5,15.27333 L715.5,15.78 L717.5,25.91333 L718.5,22.1 L720.5,16.66 L722.5,22.66 L723.5,20.95333 L725.5,15.88667 L727.5,20.76667 L728.5,21.46 L730.5,23.27333 L732.5,15.38 L734.5,19.06 L735.5,22.36667 L737.5,14.34 L739.5,19.80667 L740.5,20.1 L742.5,24.55333 L744.5,22.98 L746.5,17.16667 L747.5,23.94 L749.5,14.28667 L751.5,13.46 L752.5,16.28667 L754.5,15.59333 L756.5,21.78 L757.5,21.99333 L759.5,15.75333 L761.5,13.67333 L763.5,18.52667 L764.5,19.91333 L766.5,22.9 L768.5,16.206670000000003 L769.5,20.02 L771.5,19.75333 L773.5,21.3 L774.5,12.95333 L776.5,14.63333 L778.5,13.38 L780.5,21.46 L781.5,24.39333 L783.5,13.56667 L785.5,18.9 L786.5,22.71333 L788.5,23.59333 L790.5,18.66 L792.5,25.24667 L793.5,24.44667 L795.5,24.18 L797.5,14.84667 L798.5,21.27333 L800.5,17.16667 L802.5,19.3 L803.5,20.23333 L805.5,12.5 L807.5,18.5 L809.5,11.7 L810.5,22.92667 L812.5,12.71333 L814.5,15.86 L815.5,13.99333 L817.5,16.60667 L819.5,11.54 L820.5,20.31333 L822.5,21.72667 L824.5,22.04667 L826.5,22.74 L827.5,18.23333 L829.5,11.14 L831.5,13.54 L832.5,20.9 L834.5,15.32667 L836.5,17.62 L838.5,21.72667 L839.5,12.87333 L841.5,20.71333 L843.5,16.04667 L844.5,11.19333 L846.5,13.43333 L848.5,23.06 L849.5,17.40667 L851.5,10.23333"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0"--}}
{{--                                                          stroke="#888888" stroke-linejoin="round"--}}
{{--                                                          class="amcharts-scrollbar-graph-selected-stroke"></path>--}}
{{--                                                </g>--}}
{{--                                                <g></g>--}}
{{--                                            </g>--}}
{{--                                            <g transform="translate(0,0)">--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M22.5,40.5 L22.5,40.5 L22.5,0.5" fill="none"--}}
{{--                                                          stroke-width="1" stroke-opacity="0.15" stroke="#FFFFFF"--}}
{{--                                                          class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M126.5,40.5 L126.5,40.5 L126.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M230.5,40.5 L230.5,40.5 L230.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M331.5,40.5 L331.5,40.5 L331.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M435.5,40.5 L435.5,40.5 L435.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M538.5,40.5 L538.5,40.5 L538.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M644.5,40.5 L644.5,40.5 L644.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M748.5,40.5 L748.5,40.5 L748.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                                <g>--}}
{{--                                                    <path cs="100,100" d="M852.5,40.5 L852.5,40.5 L852.5,0.5"--}}
{{--                                                          fill="none" stroke-width="1" stroke-opacity="0.15"--}}
{{--                                                          stroke="#FFFFFF" class="amcharts-scrollbar-grid"></path>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                            <g transform="translate(0,0)" visibility="visible">--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(25,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Sep</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(129,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Nov</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(233,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">2011</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(334,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Mar</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(438,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">May</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(541,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Jul</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(647,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Sep</tspan>--}}
{{--                                                </text>--}}
{{--                                                <text y="6" fill="#FFFFFF" font-family="Verdana" font-size="11px"--}}
{{--                                                      opacity="1" text-anchor="start" transform="translate(751,28.5)"--}}
{{--                                                      class="amcharts-scrollbar-label">--}}
{{--                                                    <tspan y="6" x="0">Nov</tspan>--}}
{{--                                                </text>--}}
{{--                                            </g>--}}
{{--                                            <rect x="0.5" y="0.5" width="853" height="40" rx="0" ry="0" stroke-width="0"--}}
{{--                                                  fill="#000" stroke="#000" fill-opacity="0.005"--}}
{{--                                                  stroke-opacity="0.005"></rect>--}}
{{--                                            <rect x="0" y="0.5" width="852" height="40" rx="0" ry="0" stroke-width="0"--}}
{{--                                                  fill="#000" stroke="#000" fill-opacity="0.005" stroke-opacity="0.005"--}}
{{--                                                  aria-label="Zoom chart using cursor arrows" role="menuitem"></rect>--}}
{{--                                            <g aria-label="Zoom chart using cursor arrows" role="menuitem"--}}
{{--                                               transform="translate(-17,3)">--}}
{{--                                                <image x="0" y="0" width="35" height="35"--}}
{{--                                                       xlink:href="https://www.amcharts.com/lib/3/images/dragIconRoundBig.svg"--}}
{{--                                                       class="amcharts-scrollbar-grip-left"></image>--}}
{{--                                                <rect x="0.5" y="0.5" width="25" height="40" rx="0" ry="0"--}}
{{--                                                      stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005"--}}
{{--                                                      stroke-opacity="0.005" transform="translate(5,-2)"></rect>--}}
{{--                                            </g>--}}
{{--                                            <g aria-label="Zoom chart using cursor arrows" role="menuitem"--}}
{{--                                               transform="translate(835,3)">--}}
{{--                                                <image x="0" y="0" width="35" height="35"--}}
{{--                                                       xlink:href="https://www.amcharts.com/lib/3/images/dragIconRoundBig.svg"--}}
{{--                                                       class="amcharts-scrollbar-grip-right"></image>--}}
{{--                                                <rect x="0.5" y="0.5" width="25" height="40" rx="0" ry="0"--}}
{{--                                                      stroke-width="0" fill="#000" stroke="#000" fill-opacity="0.005"--}}
{{--                                                      stroke-opacity="0.005" transform="translate(5,-2)"></rect>--}}
{{--                                            </g>--}}
{{--                                            <clipPath id="AmChartsEl-13">--}}
{{--                                                <rect x="0" y="0" width="852" height="41" rx="0" ry="0"--}}
{{--                                                      stroke-width="0"></rect>--}}
{{--                                            </clipPath>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                    <g>--}}
{{--                                        <g transform="translate(0,0)"--}}
{{--                                           class="amcharts-graph-line amcharts-graph-graphAuto0_1610363749992"></g>--}}
{{--                                        <g transform="translate(0,0)"--}}
{{--                                           class="amcharts-graph-line amcharts-graph-graphAuto0_1610363749992"></g>--}}
{{--                                    </g>--}}
{{--                                    <g>--}}
{{--                                        <g></g>--}}
{{--                                    </g>--}}
{{--                                    <g>--}}
{{--                                        <g class="amcharts-value-axis value-axis-valueAxisAuto0_1610363749992"--}}
{{--                                           transform="translate(0,0)" visibility="hidden"></g>--}}
{{--                                        <g class="amcharts-category-axis" transform="translate(0,40)"--}}
{{--                                           visibility="visible"></g>--}}
{{--                                    </g>--}}
{{--                                    <g></g>--}}
{{--                                    <g transform="translate(0,40)"></g>--}}
{{--                                    <g></g>--}}
{{--                                    <g></g>--}}
{{--                                </svg>--}}
{{--                                <a href="http://www.amcharts.com" title="JavaScript charts"--}}
{{--                                   style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 5px; top: 45px;">JS--}}
{{--                                    chart by amCharts</a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="amChartsPeriodSelector amcharts-period-selector-div"--}}
{{--                         style="margin-top: 8px; color: rgb(0, 0, 0);">--}}
{{--                        <fieldset style="border: none; padding:0">--}}
{{--                            <legend style="display: none;">Select a timeframe to show chart data</legend>--}}
{{--                            <div style="display: inline;">From: <input aria-label="From: "--}}
{{--                                                                       class="amChartsInputField amcharts-start-date-input"--}}
{{--                                                                       style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); color: rgb(0, 0, 0); outline: none; text-align: center; width: 100px;">--}}
{{--                                to: <input aria-label="to: " class="amChartsInputField amcharts-end-date-input"--}}
{{--                                           style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); color: rgb(0, 0, 0); outline: none; text-align: center; width: 100px;">--}}
{{--                            </div>--}}
{{--                            <div style="float: right; display: inline;">Zoom: <input type="button" value="10 days"--}}
{{--                                                                                     class="amChartsButton amcharts-period-input"--}}
{{--                                                                                     style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 5px; box-sizing: border-box; color: rgb(0, 0, 0); margin: 1px; opacity: 0.7; outline: none; display: inline;"><input--}}
{{--                                    type="button" value="1 month" class="amChartsButton amcharts-period-input"--}}
{{--                                    style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 5px; box-sizing: border-box; color: rgb(0, 0, 0); margin: 1px; opacity: 0.7; outline: none; display: inline;"><input--}}
{{--                                    type="button" value="1 year" class="amChartsButton amcharts-period-input"--}}
{{--                                    style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 5px; box-sizing: border-box; color: rgb(0, 0, 0); margin: 1px; opacity: 0.7; outline: none; display: inline;"><input--}}
{{--                                    type="button" value="YTD" class="amChartsButton amcharts-period-input"--}}
{{--                                    style="background: transparent; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 5px; box-sizing: border-box; color: rgb(0, 0, 0); margin: 1px; opacity: 0.7; outline: none; display: none;"><input--}}
{{--                                    type="button" value="MAX"--}}
{{--                                    class="amChartsButtonSelected amcharts-period-input-selected"--}}
{{--                                    style="background: rgb(185, 205, 245); border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 5px; box-sizing: border-box; color: rgb(0, 0, 0); margin: 1px; opacity: 1; outline: none; display: inline;">--}}
{{--                            </div>--}}
{{--                        </fieldset>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="amcharts-export-menu amcharts-export-menu-top-right amExportButton">--}}
{{--                    <ul>--}}
{{--                        <li class="export-main"><a href="#"><span>menu.label.undefined</span></a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="#"><span>Download as ...</span></a>--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#"><span>PNG</span></a></li>--}}
{{--                                        <li><a href="#"><span>JPG</span></a></li>--}}
{{--                                        <li><a href="#"><span>SVG</span></a></li>--}}
{{--                                        <li><a href="#"><span>PDF</span></a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li><a href="#"><span>Save as ...</span></a>--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="#"><span>CSV</span></a></li>--}}
{{--                                        <li><a href="#"><span>XLSX</span></a></li>--}}
{{--                                        <li><a href="#"><span>JSON</span></a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li><a href="#"><span>Annotate ...</span></a></li>--}}
{{--                                <li><a href="#"><span>Print</span></a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>









{{--@section('scripts')--}}
    <script>
        var demo2 = function demo2() {
            var chartData = [];
            generateChartData();

            function generateChartData() {
                var firstDate = new Date(2012, 0, 1);
                firstDate.setDate(firstDate.getDate() - 500);
                firstDate.setHours(0, 0, 0, 0);

                for (var i = 0; i < 500; i++) {
                    var newDate = new Date(firstDate);
                    newDate.setDate(newDate.getDate() + i);
                    var a = Math.round(Math.random() * (40 + i)) + 100 + i;
                    var b = Math.round(Math.random() * 100000000);
                    chartData.push({
                        "date": newDate,
                        "value": a,
                        "volume": b
                    });
                }
            }

            var chart = AmCharts.makeChart("kt_amcharts_2", {
                "type": "stock",
                "theme": "light",
                "dataSets": [
                    {
                        "color": "#b0de09",
                        "fieldMappings": [{
                            "fromField": "value",
                            "toField": "value"
                        }, {
                            "fromField": "volume",
                            "toField": "volume"
                        }],
                        "dataProvider": chartData,
                        "categoryField": "date",
                        // EVENTS
                        "stockEvents": [
                            {
                                "date": new Date(2010, 8, 19),
                                "type": "sign",
                                "backgroundColor": "#85CDE6",
                                "graph": "g1",
                                "text": "S",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2010, 10, 19),
                                "type": "flag",
                                "backgroundColor": "#FFFFFF",
                                "backgroundAlpha": 0.5,
                                "graph": "g1",
                                "text": "F",
                                "description": "Some longer text can also be added"
                            }, {
                                "date": new Date(2010, 11, 10),
                                "showOnAxis": true,
                                "backgroundColor": "#85CDE6",
                                "type": "pin",
                                "text": "X",
                                "graph": "g1",
                                "description": "This is description of an event"
                            },
                            {
                                "date": new Date(2010, 11, 26),
                                "showOnAxis": true,
                                "backgroundColor": "#85CDE6",
                                "type": "pin",
                                "text": "Z",
                                "graph": "g1",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 0, 3),
                                "type": "sign",
                                "backgroundColor": "#85CDE6",
                                "graph": "g1",
                                "text": "U",
                                "description": "This is description of an event"
                            },
                            {
                                "date": new Date(2011, 1, 6),
                                "type": "sign",
                                "graph": "g1",
                                "text": "D",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 3, 5),
                                "type": "sign",
                                "graph": "g1",
                                "text": "L",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 3, 5),
                                "type": "sign",
                                "graph": "g1",
                                "text": "R",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 5, 15),
                                "type": "arrowUp",
                                "backgroundColor": "#00CC00",
                                "graph": "g1",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 6, 25),
                                "type": "arrowDown",
                                "backgroundColor": "#CC0000",
                                "graph": "g1",
                                "description": "This is description of an event"
                            }, {
                                "date": new Date(2011, 8, 1),
                                "type": "text",
                                "graph": "g1",
                                "text": "Longer text can also be displayed",
                                "description": "This is description of an event"
                            }]
                    }],
                "panels": [{
                    "title": "Value",
                    "stockGraphs": [{
                        "id": "g1",
                        "valueField": "value"
                    }],
                    "stockLegend": {
                        "valueTextRegular": " ",
                        "markerType": "none"
                    }
                }],
                "chartScrollbarSettings": {
                    "graph": "g1"
                },
                "chartCursorSettings": {
                    "valueBalloonsEnabled": true,
                    "graphBulletSize": 1,
                    "valueLineBalloonEnabled": true,
                    "valueLineEnabled": true,
                    "valueLineAlpha": 0.5
                },
                "periodSelector": {
                    "periods": [{
                        "period": "DD",
                        "count": 10,
                        "label": "10 days"
                    }, {
                        "period": "MM",
                        "count": 1,
                        "label": "1 month"
                    }, {
                        "period": "YYYY",
                        "count": 1,
                        "label": "1 year"
                    }, {
                        "period": "YTD",
                        "label": "YTD"
                    }, {
                        "period": "MAX",
                        "label": "MAX"
                    }]
                },
                "panelsSettings": {
                    "usePrefixes": true
                },
                "export": {
                    "enabled": true
                }
            });
        };
    </script>
{{--@endsection--}}
