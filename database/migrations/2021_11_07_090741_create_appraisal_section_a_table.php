<?php

use App\Models\AppraisalSectionA;
use App\Models\AppraisalSectionB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalSectionATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_section_a', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('KRA');
            $table->text('KPI');
            $table->integer('weightage');
            $table->timestamps();
        });
        AppraisalSectionA::upsert([
            [
                'designation_id'=>1,
                'KRA'=>"Development Project Delivery",
                'KPI'=>"100% attention to issues and risk & take timely action
                        Timely delivery of all booked work as per the scope of the development team i.e Maximum deviation from planned cost 10%
                        Rate of Schedule and effort variance milestones
                        100% clear definition/assignment of dependencies",
                'weightage'=>30
            ],
            [
                'designation_id'=>1,
                'KRA'=>"Development Project Acceptance",
                'KPI'=>"100% Efficiency in process and work flows especially on the app logic to avoid redundancy as per defined project guidelines.
                        Optimum quality or work completed. Booked work meet the requirements defined in the deliverable and adheres to the project guidelines i.e. Maximum rejection rate <5%
                        Number of Rework or Breakage
                        Number of bugs raised",
                'weightage'=>15
            ],

            [
                'designation_id'=>1,
                'KRA'=>"App security and Integrity",
                'KPI'=>"1) 100% contribution to Planning and development inputs
                2) 100% Effective requirement-tracking
                3) 100% compliance to project timelines and budget effort.
                4) Rejections: Effective tracking of rejections. No slippage in tracking rejections. Less than 2 percent rejections from the team
                5) Number of Technical contribution to design
                6) Number of Technical Audits conducted to ensure quality of design and code.
                7)  Periodic (as agreed) timely Status updates
                8) 100% compliance to Configuration Management
                9) Ensures Interface Design between modules is at 100% ",
                                'weightage'=>20
            ],
            [
                'designation_id'=>1,
                'KRA'=>"Quality and Processing of Apps",
                'KPI'=>"1)Number of regression bugs/No of non-regression bug found in apps
                2)Defect Quality Trend (By Priority and Severity) i.e. Maintained quality of bugs triaged and ensure test scenarios are standardized with optimum accuracy based on recurring resolution methods used to resolve bugs
                3)Excellent customer management consistent score of 4 out of 5 quarterly
                4)Response time to booked work
                5)Updated app documentation
                6)100% Optimum efficiency of apps
                7)Number of identified non conformities in audits i.e, Zero Non Conformities in Audits and documentation quarterly
                ",
                'weightage'=>15
            ],
            [
                'designation_id'=>1,
                'KRA'=>"Reporting ",
                'KPI'=>"1. Prompt, error free, complete reports on project focus areas i.e. test reports periodically
                    2. Timetable performance of schedules as per planned deliverables
                    3. Updated and maintain relevant app documents
                    4. 100% adherence to the set policies and procedures
                    5. Regular updation of project documentation
                    ",
                'weightage'=>10
            ],
            [
                'designation_id'=>1,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
                2)No of reported breach of Company  policies
                ",
                'weightage'=>5
            ],
             [
                'designation_id'=>1,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. No of innovative recommendations to client to improve on their services
                2. No of visible coaching to employees
                3. Pro-activeness and owning the tasks and deliverables
                4.Communication with stakeholders Zero communication gap among the stakeholders
                5. Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced
                6.100% compliance to SLAs, Severity levels timelines, procedures, schedules and attendance
                ",
                'weightage'=>5
                ],
            [
                'designation_id'=>17,
                'KRA'=>"Sales order booking target",
                'KPI'=>" 1.% of traction towards achieved the Sales Target as per defined sales process
                2. Number of accounts accurately mapped
                3. Number of successful bids pitched by the Company due to accurate understanding the requirements of the prospect
                4.Number of signed order bookings by customer against assigned targets
                5.Number of contracts signed % Collections on opportunities mapped
                6.Profitability of deals/contracts negotiated by sales representatives
                7.% of achievement of allocated sales target as per YTD
                8.% of collection achieved ",
                'weightage'=>40
            ],
            [
                'designation_id'=>17,
                'KRA'=>"Pipeline generation",
                'KPI'=>"1. Worth of qualified opportunities/Pipeline (At least 3 times)
                2. Driving the sales cycle/Checking the progress towards closure
                3. Excellent pitch and understanding of a solution to match client requirement
                4.Optimized cross selling of solutions to match client needs
                5. No of new vs repeat business
                ",
                'weightage'=>20
            ],
            [
                'designation_id'=>17,
                'KRA'=>"Win loss ratio",
                'KPI'=>"1.Ratio of deals won to the deals lost (won deals to be more than lost deals)
                2.Number of client meetings attended on a weekly basis
                3.% opportunity risk on deals (less than x %)
                4.Number of pitches/ value proposition of solutions to clients on a weekly basis
                5.Number of solution demos secured to optimize win rate
                6.Unmatched excellence and connection between presales and sales efforts in closure of deals
                7. Variance reduction on blind deals (not more than 5 blind deals in a FY) in comparison to mapped opportunities",
                'weightage'=>20
            ],
            [
                'designation_id'=>17,
                'KRA'=>"Sales reporting",
                'KPI'=>"1. Timely, accurate, complete CRM Updates on accounts i.e. opportunities, activities and deals undertakings on client facing updates only
2.Targets vs Closure Monthly Report
3.Collections Report Monthly",
                'weightage'=>10
            ],
            [
                'designation_id'=>17,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
                 2)No of reported breach of Company  policies",
                'weightage'=>5
            ],
            [
                'designation_id'=>17,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. 100% tracking of project as per checklist and monthly SBU reviews
2. 90% of projects complete within effort, cost and schedule. (Profitable)
3. 100% tracking, driving and closure of business and support issues
4. 100% testimonial received from all client",
                'weightage'=>5
            ],

            [
                'designation_id'=>21,
                'KRA'=>"Service delivery",
                'KPI'=>"1) Excellent messengerial and hospitality services
2) General office cleanliness and house keeping
3) Kitchen stock replenishing
4)Timely requisition of supplies i.e. shopping, gas or other work aids required from time to time
5) Ensure office environment is well maintained and constantly fumigated to keep away pests and rodents.
6) Clean and professional presentation of the office i.e. Meeting rooms, reception areas, Kitchen etc.
7) Speedy compliance to set SLAs i.e. serving tea to staff
8) Accurate update on work register",
                'weightage'=>40
            ],
            [
                'designation_id'=>21,
                'KRA'=>"Information management",
                'KPI'=>"1) Properly account for kitchenware, tableware and utensils allocated to the kitchen
2) Guides staff on proper use of all electronics allocated to the kitchen
3) Reports any issues in the kitchen to line manager
4) Safe keeping of items allocated to your kitchen
5) 100% Compliance correctness, timeliness, relevance, updated generation of required reports/requisitions/inventory
6) Zero ISO Non- Conformance should be reported
",
                'weightage'=>30
            ],

            [
                'designation_id'=>21,
                'KRA'=>"Customer satisfaction",
                'KPI'=>"1) Excellent hosting experience of staff based on feedback received
2) Number of escalations raised monthly.",
                'weightage'=>20
            ],
            [
                'designation_id'=>21,
                'KRA'=>"Reporting and tracking",
                'KPI'=>"1) Updating of relevant Reports e.g. inventory, Delivery and collection tracker etc.
2) Promptly update on any service requirements eg. shopping you need done, petty cash to carry out messengerial work etc",
                'weightage'=>5
            ],
            [
                'designation_id'=>21,
                'KRA'=>"Individual stretch",
                'KPI'=>"1)Proactiveness and owning the tasks and deliverables
2)Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
3)Communication with stakeholders Zero communication gap among the stakeholders
4)100% compliance to procedures and processes of department and work schedule attendance
",
                'weightage'=>5
            ],

            [
                'designation_id'=>10,
                'KRA'=>"Reports & Analytics",
                'KPI'=>"1. Workforce reports
2. Projection analytics to clients
3. Productivity reports
4. Quality reports
5. Trainees status reports",
                'weightage'=>50
            ],

            [
                'designation_id'=>10,
                'KRA'=>"Customer satisfaction",
                'KPI'=>"1. TAT of delivered tasks/projects within set SLAs
2. Score of CSAT of 4 out of 5 as per feedback forms
3. Number of client value addition opportunities demonstrated to ensure up sale or cross selling for purposes of improve quality of work i.e. quality score and number of recommendations in MBR, Ops Review/ISO review
4. Zero escalation from clients
5. Tracking Zero slippage on SLAs for all teams
",
                'weightage'=>40
            ],

            [
                'designation_id'=>10,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies",
                'weightage'=>5
            ],
            [
                'designation_id'=>10,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. No of innovative recommendations to client to improve on their services
2. No of visible coaching to employees
3. Pro-activeness and owning the tasks and deliverables
4. Communication with stakeholders Zero communication gap among the stakeholders
5. Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
6. 100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],

            [
                'designation_id'=>12,
                'KRA'=>"IT operation",
                'KPI'=>"1. Turn Around Time /response time in line with the internal guidelines and resolutions of systems malwares, updation of softwares, Password  management and other IT trouble shooting matters etc as per defined SLAs
2. Server, Network & Internet Performance i.e. Proper routine Server administration tasks, management of downtimes, efficient allocation of available ICT resources and effective data center/server room management
3.  Efficient and effective management of network and telephony equipment and services e.g. Network Switches, Routers, Firewalls, Gateways
4. Visibility, Rapport and quality of feedback from users and stakeholders based on capability to provide good services and handle issues
5. Help desk resolution rate of queries as per tracker/SLAs performance
6. Ensure IT escalations per quarter are no more 1 issues per quarter.
7. Systems & Applications Management i.e Prompt system administration tasks like deactivating exited staff, registering new staff, activation and deactivation of emails, biometrics, SAP, CRM and other electronic platforms within the organization as per HR request on a needs basis
8. 100% tracking and accountability of asset management registers across departments monthly; updation of asset replacement reports and competitive souriing of quotations
9. Ensure backups of Systems, Servers and Network backups are scheduled, performed, tested and at all times kept upto date and in a safe environment
10. % of new ideas/processes or improvements you have contributed to make ICT services better and faster
11. % Compliance requirements as per defined regulations
12. Track vendor deliveries i.e. hardware",
                'weightage'=>50
            ],

            [
                'designation_id'=>12,
                'KRA'=>"Risk management",
                'KPI'=>"1. 100 % accuracy of reports and updated tracking of ICT Assets, licenses inventory and ease of information retrieval from time to time
2.  ISMS policy compliance i.e. Implement security solutions
3.  measures in the company network e.g. Antivirus, Anti-Malware, Systems updates, Firewall, VPN, Active Directory policies, CCTV etc.
4.  % efficiency of risk mitigation and business continuity plans for the systems present in your location e.g. failover plans, functional backups, backup testing and recovery tools
5.  % accuracy of facts and content when generating Report .  Demonstrate use of several data points to support facts and ensuring such reports can be used to make critical decisions.
6. Implement and manage security solutions and measures in the company network e.g. Antivirus, Anti-Malware, Systems updates, Firewall, Active Directory etc.",
                'weightage'=>20
            ],

            [
                'designation_id'=>12,
                'KRA'=>"Reporting & Analysis",
                'KPI'=>"1. % accuracy of facts and content when generating Reports.  Demonstrate use of several data points to support facts and ensuring such reports can be used to make critical decisions
2. Accurate updation of IT issue tracker and closure of tasks delegated as per defined SLAs
3.  Prompt, error free, complete reports on project focus areas i.e. test reports periodically
4. Number of compliance issues reported in a quarter
5. Timetable performance of schedules as per planned deliverables
6. Updated and maintain relevant app documents",
                'weightage'=>20
            ],


            [
                'designation_id'=>12,
                'KRA'=>"Governance",
                'KPI'=>")Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies",
                'weightage'=>5
            ],

            [
                'designation_id'=>12,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. No of innovative recommendations to client to improve on their services
2. No of visible coaching to employees
3. Pro-activeness and owning the tasks and deliverables
4.Communication with stakeholders Zero communication gap among the stakeholders
5. Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced
6.100% compliance to SLAs, Severity levels timelines, procedures, schedules
",
                'weightage'=>5
            ],




            [
                'designation_id'=>14,
                'KRA'=>"IT operation",
                'KPI'=>"1. Turn Around Time /response time in line with the internal guidelines and resolutions of systems malwares, updation of softwares, Password  management and other IT trouble shooting matters etc as per defined SLAs
2. Server, Network & Internet Performance i.e. Proper routine Server administration tasks, management of downtimes, efficient allocation of available ICT resources and effective data center/server room management
3.  Efficient and effective management of network and telephony equipment and services e.g. Network Switches, Routers, Firewalls, Gateways
4. Visibility, Rapport and quality of feedback from users and stakeholders based on capability to provide good services and handle issues
5. Help desk resolution rate of queries as per tracker/SLAs performance
6. Ensure IT escalations per quarter are no more 1 issues per quarter.
7. Systems & Applications Management i.e Prompt system administration tasks like deactivating exited staff, registering new staff, activation and deactivation of emails, biometrics, SAP, CRM and other electronic platforms within the organization as per HR request on a needs basis
8. 100% tracking and accountability of asset management registers across departments monthly; updation of asset replacement reports and competitive souriing of quotations
9. Ensure backups of Systems, Servers and Network backups are scheduled, performed, tested and at all times kept upto date and in a safe environment
10. % of new ideas/processes or improvements you have contributed to make ICT services better and faster
11. % Compliance requirements as per defined regulations
12. Track vendor deliveries i.e. hardware",
                'weightage'=>50
            ],

            [
                'designation_id'=>14,
                'KRA'=>"Risk management",
                'KPI'=>"1. 100 % accuracy of reports and updated tracking of ICT Assets, licenses inventory and ease of information retrieval from time to time
2.  ISMS policy compliance i.e. Implement security solutions
3.  measures in the company network e.g. Antivirus, Anti-Malware, Systems updates, Firewall, VPN, Active Directory policies, CCTV etc.
4.  % efficiency of risk mitigation and business continuity plans for the systems present in your location e.g. failover plans, functional backups, backup testing and recovery tools
5.  % accuracy of facts and content when generating Report .  Demonstrate use of several data points to support facts and ensuring such reports can be used to make critical decisions.
6. Implement and manage security solutions and measures in the company network e.g. Antivirus, Anti-Malware, Systems updates, Firewall, Active Directory etc.",
                'weightage'=>20
            ],

            [
                'designation_id'=>14,
                'KRA'=>"Reporting & Analysis",
                'KPI'=>"1. % accuracy of facts and content when generating Reports.  Demonstrate use of several data points to support facts and ensuring such reports can be used to make critical decisions
2. Accurate updation of IT issue tracker and closure of tasks delegated as per defined SLAs
3.  Prompt, error free, complete reports on project focus areas i.e. test reports periodically
4. Number of compliance issues reported in a quarter
5. Timetable performance of schedules as per planned deliverables
6. Updated and maintain relevant app documents",
                'weightage'=>20
            ],


            [
                'designation_id'=>14,
                'KRA'=>"Governance",
                'KPI'=>")Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies",
                'weightage'=>5
            ],

            [
                'designation_id'=>14,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. No of innovative recommendations to client to improve on their services
2. No of visible coaching to employees
3. Pro-activeness and owning the tasks and deliverables
4.Communication with stakeholders Zero communication gap among the stakeholders
5. Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced
6.100% compliance to SLAs, Severity levels timelines, procedures, schedules
",
                'weightage'=>5
            ],



            [
                'designation_id'=>5,
                'KRA'=>"Project excellence",
                'KPI'=>"1) % or Number of recorded Team Productivity based on Actual Production against defined target
2) 100% delivery of project within schedule, effort with minimal variance as per signed off project plans defined in operations requirements
3) Number of accomplished daily assignments as per contracted projects i.e. Team hourly performance etc
4) Number of adequate closures of escalated client queries resolved within defined SLAs
5) 100% adherence to shift management rotter to deliver project as per operations requirements
6) % of Productivity met as per monthly target for assigned projects
7) Complete, prompt, error free periodic productivity reports
",
                'weightage'=>40
            ],

            [
                'designation_id'=>5,
                'KRA'=>"Customer satisfaction",
                'KPI'=>"1) TAT of delivered tasks/projects within set SLAs
2) Score of CSAT of 4 out of 5 as per feedback forms
3) Number of client value addition opportunities demonstrated to ensure up sale or cross selling for purposes of improve quality of work i.e. quality score and number of recommendations in MBR, Ops Review/ISO review
4) Zero escalation from clients",
                'weightage'=>20
            ],


            [
                'designation_id'=>5,
                'KRA'=>"Resource management",
                'KPI'=>"1) 100 % Team Attendance as per schedule
2) Number of team capacity building, coaching, mentorship/job shadowing of resources to optimize productivity at all times
3) Minimum of 1.5% attrition rate of resources allotted within a project
4) Number of visible praises to team on productivity matters
5) Quality of feedback from direct reportees regarding clarity of role, assignment delegated and engaging conversation that drives improvement and productivity within team
",
                'weightage'=>20
            ],

            [
                'designation_id'=>5,
                'KRA'=>"Quality delivery",
                'KPI'=>"1. Quality scores as per contracted projected
2. No of NC's -  ISO Audits, Corrective and Preventive Action (CAPA) maintenance
3. Number of reported scores of standardizations of processes as per defined Standard Operation procedure/SOP for all projects defined by operations requirements
",
                'weightage'=>10
            ],

            [
                'designation_id'=>5,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies
",
                'weightage'=>5
            ],

            [
                'designation_id'=>5,
                'KRA'=>"Individual stretch",
                'KPI'=>"1) No of innovative recommendations to client to improve on their services
2) No of visible coaching to employees
3)Pro-activeness and owning the tasks and deliverables
4) Communication with stakeholders Zero communication gap among the stakeholders
5) Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
6) 100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],



            [
                'designation_id'=>6,
                'KRA'=>"Project excellence",
                'KPI'=>"1) % or Number of recorded Team Productivity based on Actual Production against defined target
2) 100% delivery of project within schedule, effort with minimal variance as per signed off project plans defined in operations requirements
3) Number of accomplished daily assignments as per contracted projects i.e. Team hourly performance etc
4) Number of adequate closures of escalated client queries resolved within defined SLAs
5) 100% adherence to shift management rotter to deliver project as per operations requirements
6) % of Productivity met as per monthly target for assigned projects
7) Complete, prompt, error free periodic productivity reports
",
                'weightage'=>40
            ],

            [
                'designation_id'=>6,
                'KRA'=>"Customer satisfaction",
                'KPI'=>"1) TAT of delivered tasks/projects within set SLAs
2) Score of CSAT of 4 out of 5 as per feedback forms
3) Number of client value addition opportunities demonstrated to ensure up sale or cross selling for purposes of improve quality of work i.e. quality score and number of recommendations in MBR, Ops Review/ISO review
4) Zero escalation from clients",
                'weightage'=>20
            ],


            [
                'designation_id'=>6,
                'KRA'=>"Resource management",
                'KPI'=>"1) 100 % Team Attendance as per schedule
2) Number of team capacity building, coaching, mentorship/job shadowing of resources to optimize productivity at all times
3) Minimum of 1.5% attrition rate of resources allotted within a project
4) Number of visible praises to team on productivity matters
5) Quality of feedback from direct reportees regarding clarity of role, assignment delegated and engaging conversation that drives improvement and productivity within team
",
                'weightage'=>20
            ],

            [
                'designation_id'=>6,
                'KRA'=>"Quality delivery",
                'KPI'=>"1. Quality scores as per contracted projected
2. No of NC's -  ISO Audits, Corrective and Preventive Action (CAPA) maintenance
3. Number of reported scores of standardizations of processes as per defined Standard Operation procedure/SOP for all projects defined by operations requirements
",
                'weightage'=>10
            ],

            [
                'designation_id'=>6,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies
",
                'weightage'=>5
            ],

            [
                'designation_id'=>6,
                'KRA'=>"Individual stretch",
                'KPI'=>"1) No of innovative recommendations to client to improve on their services
2) No of visible coaching to employees
3)Pro-activeness and owning the tasks and deliverables
4) Communication with stakeholders Zero communication gap among the stakeholders
5) Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
6) 100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],


            [
                'designation_id'=>22,
                'KRA'=>"Service delivery",
                'KPI'=>"1) Excellent front office  etiquette
2) Supervise and ensure state of the art maintenance of the front office area
3) Adherence to security requirements. Eg. issuing visitor badges and monitoring the visitors’ book and ensuring non entry of unauthorized personnel in to the call centres
4) Co-ordinate meetings and client visits to ensure guests are comfortable
5) Dispatch of parcels, messages or inquiries to the recipients on a timely basis
6) Speedy response to emergency cases and adequate stocking on the first aid kit
7) Track office supply inventory and acknowledge receipt of supply orders eg. Stationery, water gallons, routine emptying of sanitary bins etc.
8) Ensure that office policies, processed and procedures are successfully implemented
9)provide quality knowledge to guests/staff
10) Issuance of certificates to students
11) Excellent coordination on assigned duties

",
                'weightage'=>40
            ],

            [
                'designation_id'=>22,
                'KRA'=>"Stakeholder management",
                'KPI'=>"1)Monthly / periodically phone calls /emails should be sent to inquiries and feedback forms filed in respective file.
2)Maintain ISO documentation to do with maintenance of first aid box kit, MGM, Inquiry and registration, certificate file
3)Manage client relationships, including making telephone and find out the nature of inquiry (products, pricing or schedule) from current clients on a timely basis to uncover opportunities and advance the sales process;
4)Work with center staff to provide the necessary service required for ongoing customer satisfaction;
5)Contact customers, inquirers, Job seekers through, but not limited to, phone calls and emails to communicate opportunities to extend initiatives with the company.
",
                'weightage'=>30
            ],

            [
                'designation_id'=>22,
                'KRA'=>"Reporting & tracking",
                'KPI'=>"1)% accuracy of facts and content when generating reports, demonstrate use of several datapoints to support facts and ensuring such reports can be sued to make critical decisions.
2)Effective logging of incoming mail to avoid mail loss and blame game
3)Updation of relevant Reports
4) Promptly update on any service requirements eg; restocking of first aid items, stationery e.t.c",
                'weightage'=>20
            ],

            [
                'designation_id'=>22,
                'KRA'=>"Information management",
                'KPI'=>"1)100% Compliance correctness, timeliness, relevance, updated generation of required dashboards
2) Zero ISO Non- Conformance should be reported
",
                'weightage'=>5
            ],

            [
                'designation_id'=>22,
                'KRA'=>"Individual stretch",
                'KPI'=>"1)Proactiveness and owning the tasks and deliverables
2)Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
3)Communication with stakeholders Zero communication gap among the stakeholders (max 2 issues during product mapping based on client requirements)
4)Number of innovative ideas shared and implemented per annum within assigned processes to improve productivity matrices
5)100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],


            [
                'designation_id'=>11,
                'KRA'=>"Operations service delivery",
                'KPI'=>"1)Meets the daily Target as set as per the Project ie voice calls, Innteractions and surveys
2)In bound Manage & Resolve all customer queries.
3) Number of Outbound call to customers in regards to payment inquiries and account inquiries as per assigned target
4) Outbound calls should have 100% conversions
5) Zero Escalations from customers due to mishandling
6) Timely escalations and 100% Following through on adequate closure on escalations frm client raised to the GCs and QCs to ensure they are resolved.
6) Total Time one is Available to Pick Calls/ Make Calls
7)Total Offline Activities/ update in the system
8) Zero dropping of calls
9) Meet the total no of productive hours for the day as per the assigned shift
10)Amount of calls handled against set  target
11) Number of reported absenteeism within assigned schedule",
                'weightage'=>40
            ],


            [
                'designation_id'=>11,
                'KRA'=>"Quality & Reporting",
                'KPI'=>"1) Ticketing /Coding Accuracy as per assigned project
2) severity performance of Call Quality as per required script
3) Call Script Adherence - Agent followed the required Call script
4) Call Compliance as per quality target.
5) Phone Etiquette",
                'weightage'=>25
            ],

            [
                'designation_id'=>11,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies",
                'weightage'=>5
            ],

            [
                'designation_id'=>11,
                'KRA'=>"Individual stretch",
                'KPI'=>"1. No of training attended
2. Proactiveness and owning the tasks and deliverables
3. Number of fresh approaches ideas introduced (Number of innovative ways to increase customer satisfaction)
4. 100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance",
                'weightage'=>5
            ],


            [
                'designation_id'=>4,
                'KRA'=>"Project Excellence",
                'KPI'=>"1) Liaising with clients to identify and define project requirements, scope and objectives
2) % or Number of recorded Team Productivity based on Actual Production against defined target
3) 100% delivery of project within schedule, effort with minimal variance as per signed off project plans defined in operations requirements and client agreement
4) Number of accomplished daily assignments as per contracted projects i.e. Team hourly performance etc
5) Number of adequate closures of escalated client queries resolved within defined SLAs
6) 100% adherence to shift management rotter to deliver project as per operations requirements
7) % of Productivity met as per monthly target for assigned projects
8) Complete, prompt, error free periodic comprehensive project documentation, plans and reports
9) 100% Support in billing process
",
                'weightage'=>40
            ],

            [
                'designation_id'=>4,
                'KRA'=>"Customer satisfaction",
                'KPI'=>"1) TAT of delivered tasks/projects within set SLAs
2) Score of CSAT of 4 out of 5 as per feedback forms
3) Number of client value addition opportunities demonstrated to ensure up sale or cross selling for purposes of improve quality of work i.e. quality score and number of recommendations in MBR, Ops Review/ISO review
4) Zero escalation from clients
5) Client retention %
6) Number of increased billable seats per month
",
                'weightage'=>30
            ],

            [
                'designation_id'=>4,
                'KRA'=>"Resource management",
                'KPI'=>"1) 100 % Team Attendance as per schedule
2) Number of team capacity building, coaching, mentorship/job shadowing of resources to optimize productivity at all times
3) Minimum of 4% attrition rate of resources allotted within a project
4) Number of visible praises to team on productivity matters
5) Quality of feedback from direct reportees regarding clarity of role, assignment delegated and engaging conversation that drives improvement and productivity within team
",
                'weightage'=>20
            ],

            [
                'designation_id'=>4,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies
",
                'weightage'=>5
            ],


            [
                'designation_id'=>4,
                'KRA'=>"Individual stretch",
                'KPI'=>"1)Proactiveness and owning the tasks and deliverables
2)Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
3)Communication with stakeholders Zero communication gap among the stakeholders (max 2 issues during product mapping based on client requirements)
4)Number of fresh approaches ideas introduced (Number of innovative ways to reduce overall project cost and timelines, increase customer satisfaction)
5)No of active team learnings initiated and/or participated per annum.
6)Visible team learning circles and knowledge sharing on platforms and further forward thinking on project competencies weekly
7)Number of innovative ideas shared and implemented per annum within assigned processes to improve productivity matrices
8)100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],

            [
                'designation_id'=>23,
                'KRA'=>"Service Delivery",
                'KPI'=>"1) Sort and distribute incoming mails to areas and staff within organization and dispatch outgoing mails.
2)Maintenance of professional office outlook
3)Ensure office assets e.g. Photocopiers, Printers, faxes, VOIPs are functioning optimally from time to time, update IT where malfunction is detected or toners refill is required.
4) Management of hotel and guest house booking for visiting guests, timely remittance of utility bills, following up with suppliers to ensure delivery of consumables e.g. newspapers, gas, milk etc.",
                'weightage'=>40
            ],


            [
                'designation_id'=>23,
                'KRA'=>"Stakeholder engagement",
                'KPI'=>"1) Proper, accurate and timely records maintained. (phone bills, supplies files, purchase requisitions, welfare requirements e.t.c)",
                'weightage'=>30
            ],

            [
                'designation_id'=>23,
                'KRA'=>"Governance",
                'KPI'=>"
1)General supervision of office to ensure cleanliness and safely/health standards are maintained.
2)Operate office equipment such as photocopies, computers and complete general office work including observing, receiving and otherwise obtaining information from all relevant sources.
3)Prepare purchase requisitions for staff welfare supplies
4)Perform other miscellaneous duties assigned. ",
                'weightage'=>20
            ],


            [
                'designation_id'=>23,
                'KRA'=>"Reporting",
                'KPI'=>"1) % accuracy of facts and content when generating reports. Demonstrate use of several data points to support facts and ensuring such reports can be used to make critical decisions. This includes travel reports, transport management reports, office/guest house consumables reports, PR/PO on SAP for supplies management and payment for Vendors/suppliers
2) Execute ISO recommendation, maintain ISO documentation and prepare daily /weekly / monthly reports and update dashboard",
                'weightage'=>5
            ],

            [
                'designation_id'=>23,
                'KRA'=>"Individual stretch",
                'KPI'=>"1)Proactiveness and owning the tasks and deliverables
2)Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
3)Communication with stakeholders Zero communication gap among the stakeholders
4)100% compliance to procedures and processes of department and work schedule attendance",
                'weightage'=>5
            ],

            [
                'designation_id'=>24,
                'KRA'=>"Content Delivery",
                'KPI'=>"1. 100% Product knowledge
2. Performance rate on quality excellence of calls and interactions post the training
3. Team performance based on knowledge transfer
4. Excellent topic delivery as per operations requirements
5. Periodic post assessment ratings for new hires as per QC feedback
6. Onboarding/induction on T-Brain way culture on standardized service way
7. Number of refresher training on gaps identified per process i.e. Not more than 1 per any training class",
                'weightage'=>50
            ],

            [
                'designation_id'=>24,
                'KRA'=>"Project support",
                'KPI'=>"1. Number of demo/show case product knowledge on live brands to test on knowledge transfer
2. Excellent logistics delivery on planned course
3. Excellent quality calls reported periodically
4. TAT of delivered tasks/projects within set SLAs
5. Score of CSAT of 4 out of 5 as per feedback forms
6. Number of client value addition opportunities demonstrated to ensure up sale or cross selling for purposes of improve quality of work i.e. quality score and number of recommendations in MBR, Ops Review/ISO review
7. Zero escalation from clients
",
                'weightage'=>20
            ],


            [
                'designation_id'=>24,
                'KRA'=>"Resource management",
                'KPI'=>"1. 100 % Team Attendance as per schedule
2. Number of team capacity building, coaching, mentorship/job shadowing of resources to optimize productivity at all times
3. Minimum of 4% attrition rate of successfully selected candidate and graduates post the training
4. Number of visible praises to team on productivity matters
5. Quality of feedback from direct reportees regarding clarity of role, assignment delegated and engaging conversation that drives improvement and productivity within team
6. Shortlisting of quality trainees/candidates
",
                'weightage'=>20
            ],

            [
                'designation_id'=>24,
                'KRA'=>"Governance",
                'KPI'=>"1)Professional usage of company  systems ie skype, internet, social media
2)No of reported breach of Company  policies
3. Error free, timely periodic Reports on training status, scores etc",
                'weightage'=>5
            ],

            [
                'designation_id'=>24,
                'KRA'=>"Individual Stretch",
                'KPI'=>"1) No of training attended
2) No of innovative recommendations to client to improve on their services
3) No of visible coaching to employees
4) Pro-activeness and owning the tasks and deliverables
5) Communication with stakeholders Zero communication gap among the stakeholders
6) Problem Solving Eg Number of Visible contribution to resolution of critical problems issues faced throughout the project/product lifecycle (Number of issues/risks identified)
7) 100% compliance to SLAs, Severity levels timelines, procedures and processes of project schedules and work schedule attendance
",
                'weightage'=>5
            ],


        ],['designation_id'] , ['KRA'], ['KPI']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appraisal_section_a');
    }
}
